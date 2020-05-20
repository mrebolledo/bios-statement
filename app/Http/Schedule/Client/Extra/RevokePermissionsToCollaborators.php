<?php

namespace App\Http\Schedule\Client\Extra;

use App\App\Controllers\Controller;
use App\Domain\Client\Collaborator\Collaborator;
use App\Domain\Old\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RevokePermissionsToCollaborators extends Controller
{
    public function __invoke()
    {
        $date = Carbon::now()->subDays(7)->toDateString();
        $collaborators = Collaborator::with(['statements' => function ($query) {
            $query->orderBy('id', 'desc');
        }])->has('statements')->get();

        foreach ($collaborators as $collaborator) {
            if(isset($collaborator->statements->first()->statement_date) && Carbon::parse($collaborator->statements->first()->statement_date)->toDateString() === $date ) {
                $worker = Trabajador::where(
                    'TrabajadorRut',
                    explode('-',$collaborator->identifier)[0])
                    ->first();

                $worker->TrabajadorAutRRHH = 2;
                $worker->TrabajadorMod = Carbon::now()->toDateTimeString();
                $worker->TrabajadorUsu = 'SYS-COVID';
                $worker->check = 2;
                $worker->save();
            }

        }
    }
}
