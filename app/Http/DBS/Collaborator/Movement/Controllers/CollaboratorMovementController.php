<?php

namespace App\Http\DBS\Collaborator\Movement\Controllers;

use App\App\Controllers\Controller;
use App\App\Traits\DBS\Collaborator\HasMovements;
use App\Domain\Client\Collaborator\Collaborator;
use App\Domain\DBS\Pyramid\Pyramid;
use App\Domain\DBS\Pyramid\Sector;
use App\Http\DBS\Collaborator\Movement\Requests\MovementRequest;
use Illuminate\Http\Request;

class CollaboratorMovementController extends Controller
{
    use HasMovements;

    public function simulateView($collaborator_id = null)
    {
        if($collaborator_id) {
            $collaborators = null;
            $collaborator = Collaborator::findOrFail($collaborator_id);
        } else {
            $collaborator = null;
            $collaborators = Collaborator::get();
        }
        $pyramid = Pyramid::get();
        return view('dbs.collaborator.movements.simulate',compact('collaborators','pyramid','collaborator'));
    }

    public function storeSimulation(MovementRequest $request, $collaborator_id = null)
    {
        if($collaborator_id || $request->collaborator_id) {
            $id = $collaborator_id ?? $request->collaborator_id;
            $collaborator = Collaborator::with(['accesses.authorizations','movements.sector.level.pyramid','movements.sector.zone'])->find($id);
            $sector = Sector::with(['level.pyramid.integrations','zone.integrations','level.integrations'])->find($request->sector_id);
            $message = $this->checkMovement($collaborator,$sector,$request->check_in_date);
            if($message === true) {
                $entered = 1;
            } else {
                $entered = 0;
            }
            if($request->has('insert_simulation')) {
                $collaborator->movements()->create([
                    'sector_id' => $sector->id,
                    'check_in_date' => $request->check_in_date,
                    'check_in_time' => '00:00:01',
                    'departure_date' => $request->check_in_date,
                    'departure_time' => '01:00:00',
                    'entered' => $entered,
                    'reason' => ($message === true) ? null : $message
                ]);
            }

            if($entered) {
                return response()->json(['success', 'Puede Entrar']);
            } else {
                return response()->json(['error' => $message],401);
            }
        } else {
            return response()->json(['errors' => ['collaborators' => 'Debe seleccionar un colaborador']],422);
        }
    }

}
