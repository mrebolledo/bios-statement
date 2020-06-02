<?php

namespace App\Http\Client\Extra;

use App\App\Controllers\Controller;
use App\Domain\Client\Collaborator\Collaborator;
use App\Domain\Client\Enterprise\Enterprise;
use App\Domain\Client\Extra\Statement\CollaboratorStatement;
use App\Domain\Old\Empresa;
use App\Domain\Old\Trabajador;
use App\Mail\Client\Extra\StatementMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as LaravelMailer;

class StatementController extends Controller
{
    public function list($id)
    {
        $collaborator = Collaborator::with('statements','enterprise')->find($id);
        return view('client.extra.list',compact('collaborator'));
    }

    public function index()
    {
        return view('app.CRUD.index-blank', [
            'columns' => [
                'Identificador',
                'Nombre',
                'Apellido',
                'Email',
                'Telefono',
                'Empresa RUT',
                'Empresa Nombre',
                'Empresa Email',
                'Empresa Telefono',
                'Declaraciones',
            ],
            'entity' => 'statement',
            'title' => 'Listado de colaboradores y sus declaraciones',
            'icon' => 'fa-list',
            'filter' => false
        ]);
    }
    public function postStatement(StatementRequest $request)
    {
        if(stristr($request->rut,'-')) {
            if (validateRut($request->rut)) {
                $worker = Trabajador::where('TrabajadorRut',explode('-',$request->rut)[0])
                    ->first();
                if($worker) {

                    if(true) {
                        if(!$collaborator = Collaborator::findByIdentifier($request->rut)) {
                            $empresa = Empresa::where('EmpresaRut', $worker->EmpresaRut)->first();
                            if(!$enterprise = Enterprise::where('rut',$worker->EmpresaRut.'-'.$empresa->EmpresaDV)->first()) {
                                $enterprise = Enterprise::create([
                                    'rut' => $worker->EmpresaRut.'-'.$empresa->EmpresaDV,
                                    'name' => $empresa->EmpresaRaz,
                                    'phone' => $empresa->EmpresaTel,
                                    'email' => $empresa->EmpresaEmailEmp,
                                    'principal_email' => $empresa->EmpresaEmailAS,
                                    'principal_name' => $empresa->EmpresaCorAS,
                                    'representative' => $empresa->EmpresaCorEmp,
                                ]);
                            }
                            $collaborator = Collaborator::create([
                                'identifier' => $request->rut,
                                'first_name' => $worker->TrabajadorNom,
                                'last_name' => $worker->TrabajadorApp,
                                'enterprise_id' => $enterprise->id,
                                'last_access' => Carbon::now()->toDateTimeString(),
                                'access_start' => Carbon::now()->toDateString(),
                                'email' => $request->email,
                                'phone' => '+56'.$request->phone
                            ]);
                        }
                        if($last_statement = $collaborator->statements()->orderBy('id','desc')->first()) {
                            if(Carbon::now()->diffInDays(Carbon::parse($last_statement->statement_date)->toDateString()) < 14) {
                                if($worker->TrabajadorAutRRHH = 2) {
                                    $worker->TrabajadorAutRRHH = 1;
                                    $worker->TrabajadorMod = Carbon::now()->toDateTimeString();
                                    $worker->TrabajadorUsu = 'SYS-COVID';
                                    $worker->check = 1;
                                    $worker->save();
                                }
                                return response()->json(['error' => 'Posee una declaración vigente, realizada hace menos de 14 días.'],401);
                            }
                        }
                        $can_enter = 1;
                        $reason = null;

                        if((int)$request->statement_1 !== 0 || (int)$request->statement_2 !== 0 || (int)$request->statement_3 !== 0 || (int)$request->statement_4 !== 0) {
                            $can_enter = 0;
                            $reason = 'Una de las opciones marcadas fue un SI o la cuarta fue NO';
                        }

                        $collaborator->statements()->create([
                            'statement_date' => Carbon::now()->toDateTimeString(),
                            'statement_1' => $request->statement_1,
                            'statement_2' => $request->statement_2,
                            'statement_3' => $request->statement_3,
                            'statement_4' => $request->statement_4,
                            'can_enter' => $can_enter,
                            'reason' => $reason,
                        ]);
                        $is_unique = 0;
                        do {
                            $code = random_code();
                            if(!CollaboratorStatement::where('verification_code',$code)->first())
                            {
                                $is_unique = 1;
                            }
                        } while($is_unique === 0);


                        $lastStatement = $collaborator->statements()->orderBy('id','desc')->first();
                        $lastStatement->verification_code = $code;
                        $lastStatement->save();

                        if($can_enter === 1) {
                            $worker->TrabajadorAutRRHH = 1;
                            $worker->TrabajadorMod = Carbon::now()->toDateTimeString();
                            $worker->TrabajadorUsu = 'SYS-COVID';
                            $worker->check = 1;
                            $worker->save();
                        } else {
                            $worker->TrabajadorAutRRHH = 2;
                            $worker->TrabajadorMod = Carbon::now()->toDateTimeString();
                            $worker->TrabajadorUsu = 'SYS-COVID';
                            $worker->check = 2;
                            $worker->save();
                        }

                        LaravelMailer::to($collaborator->email)
                            ->send(new StatementMail($collaborator));


                        return response()->json(['success' => 'Declaración enviada correctamente.'],200);
                    } else {
                        if(!$collaborator = Collaborator::findByIdentifier($request->rut)) {
                            $empresa = Empresa::where('EmpresaRut', $worker->EmpresaRut)->first();
                            if(!$enterprise = Enterprise::where('rut',$worker->EmpresaRut.'-'.$empresa->EmpresaDV)->first()) {
                                $enterprise = Enterprise::create([
                                    'rut' => $worker->EmpresaRut.'-'.$empresa->EmpresaDV,
                                    'name' => $empresa->EmpresaRaz,
                                    'phone' => $empresa->EmpresaTel,
                                    'email' => $empresa->EmpresaEmailEmp,
                                    'principal_email' => $empresa->EmpresaEmailAS,
                                    'principal_name' => $empresa->EmpresaCorAS,
                                    'representative' => $empresa->EmpresaCorEmp,
                                ]);
                            }
                            $collaborator = Collaborator::create([
                                'identifier' => $request->rut,
                                'first_name' => $worker->TrabajadorNom,
                                'last_name' => $worker->TrabajadorApp,
                                'enterprise_id' => $enterprise->id,
                                'last_access' => Carbon::now()->toDateTimeString(),
                                'access_start' => Carbon::now()->toDateString(),
                                'email' => $request->email,
                                'phone' => '+56'.$request->phone
                            ]);
                        }
                        if($last_statement = $collaborator->statements()->orderBy('id','desc')->first()) {
                            if(Carbon::now()->diffInDays(Carbon::parse($last_statement->statement_date)->toDateString()) < 14) {
                                return response()->json(['error' => 'Posee una declaración vigente, realizada hace menos de 14 días.'],401);
                            }
                        }
                        return response()->json(['error' =>  'Ya existe una declaración vigente.'],401);
                    }
                } else {
                    return response()->json(['error' =>  'el RUT no existe en base de datos, contacte al administrador.'],401);
                }
            } else {
                return response()->json(['errors' => ['rut' => 'el RUT es inválido']],422);
            }
        } else {
            return response()->json(['errors' => ['rut' => 'Falta el "-" en el RUT, utilice formato ej: 11111111-1']],422);
        }
    }

    public function findRUT($rut)
    {
        if(stristr($rut,'-')) {
            if (validateRut($rut)) {
                $worker = Trabajador::where('TrabajadorRut',explode('-',$rut)[0])
                    ->first();
                if($worker) {
                    $enterprise = Empresa::where('EmpresaRut', $worker->EmpresaRut)->first();
                    return json_encode([
                        'worker_name' => $worker->TrabajadorNom.' '.$worker->TrabajadorApp,
                        'enterprise' => $enterprise->EmpresaRut.'-'.$enterprise->EmpresaDV.' > '.$enterprise->EmpresaRaz
                    ]);
                } else {
                    return response()->json(['error' => 'El RUT ingresado no existe en nuestra base de datos, contacte al administrador.'],401);
                }
            } else {
                return response()->json(['error'=>'Rut no Válido'],401);
            }
        } else {
            return response()->json(['error'=>'Falta guión en RUT'],401);
        }
    }

    public function verifyView()
    {
        return view('client.extra.verify');
    }

    public function postCode(Request $request)
    {
        $statement = CollaboratorStatement::with('collaborator.enterprise')->code($request->code)->first();
        if ($statement) {
            return view('client.extra.success',compact('statement'));
        } else {
            return  view('client.extra.failed');
        }
    }
}
