<?php

namespace App\Http\Client\Collaborator\Controllers;

use App\App\Controllers\Controller;
use App\Domain\Client\Collaborator\Collaborator;
use App\Domain\DBS\Pyramid\Pyramid;
use App\Domain\System\User\User;
use Illuminate\Http\Request;

class CollaboratorSectorsController extends Controller
{
    public function index($collaborator_id)
    {
        $collaborator = Collaborator::with('accesses.authorizations')->findOrFail($collaborator_id);
        $pyramids = Pyramid::with('levels.sectors.zone')->get();
        return view('client.collaborator.sectors.index',compact('collaborator','pyramids'));
    }

    public function store(Request $request, Collaborator $collaborator)
    {
        $request->validate([
            'access_start' => 'required',
            'access_expires' => 'required'
        ]);

        $user = auth()->user();
        $collaborator->update([
            'access_start' => $request->access_start,
            'access_expires' => $request->access_expires
        ]);

        foreach($request->sectors as $sector) {
            $access = $collaborator->accesses()->updateOrCreate(
                ['sector_id' => $sector],
                ['allowed' => true]
            );
        }

        $notAllowedSectors = $collaborator->accesses()->whereNotIn('sector_id',$request->sectors)->get();
        foreach($notAllowedSectors  as $sector) {
            $sector->updateOrCreate(
                ['sector_id' => $sector->sector_id],
                ['allowed' => false]
            );
        }

        foreach($collaborator->accesses()->with(['authorizations' => function($query) {
            $query->orderBy('id','desc')->where('is_valid',true)->where('type','from-collaborator-permissions');
        }])->get() as $access) {
            $last_auth = $access->authorizations->first();
            if (
                !$last_auth ||
                $last_auth->start_date !== $request->access_start ||
                $last_auth->end_date !==  $request->access_expires ||
                $last_auth->gives_access !== $access->allowed
            ) {
                if($last_auth ) {
                    $last_auth->is_valid = false;
                    $last_auth->save();
                }
                $user->authorizations()->create([
                        'creator_id' => $user->id,
                        'collaborator_sector_id' => $access->id,
                        'description' => 'Permiso modificado desde el panel de sectores del colaborador.',
                        'type' => 'from-collaborator-permissions',
                        'start_date' => $request->access_start,
                        'end_date' => $request->access_expires,
                        'priority' => 5,
                        'gives_access' => $access->allowed
                    ]);
                }


        }

        return response()->json(['success' => 'Accesos modificados correctamente.']);
    }
}
