<?php

namespace App\Http\DataTable\Controllers;

use App\App\Controllers\Controller;
use App\App\Controllers\DataTableAbstract;
use App\Domain\DBS\Movement\CollaboratorMovement;
use Illuminate\Http\Request;

class CollaboratorMovementDataTableController extends DataTableAbstract
{
    public function getRecords()
    {
        return CollaboratorMovement::where('collaborator_id',$this->filter)
                    ->with(['sector.zone','sector.level.pyramid'])->orderBy('id','desc')->get();
    }

    public function map($record): array
    {
        return [
            $record->sector->level->pyramid->name,
            $record->sector->level->name,
            $record->sector->name,
            $record->sector->zone->name,
            $record->check_in_date,
            $record->check_in_time,
            $record->departure_date,
            $record->departure_time,
            ($record->entered === 1)?'Sí':'No',
            $record->reason
       ];
    }
}
