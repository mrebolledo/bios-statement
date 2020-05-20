<?php

namespace App\Http\Datatable\Controllers;

use App\App\Controllers\Controller;
use App\App\Controllers\DataTableAbstract;
use App\Domain\Client\Collaborator\Collaborator;
use Illuminate\Http\Request;

class StatementDataTableController extends DataTableAbstract
{
    public function getRecords()
    {
        return Collaborator::with(['enterprise','statements'])->withCount('statements')->get();
    }

    public function map($record):array
    {
        return [
            $record->identifier,
            $record->first_name,
            $record->last_name,
            $record->email,
            $record->phone,
            $record->enterprise->rut,
            $record->enterprise->name,
            $record->enterprise->email,
            $record->enterprise->phone,
            ($record->statements_count > 0)? makeRemoteLink("/collaborator/{$record->id}/statements","Declaraciones",'fa-list','btn-link','btn-sm'):'No ha Declarado'
        ];
    }
}
