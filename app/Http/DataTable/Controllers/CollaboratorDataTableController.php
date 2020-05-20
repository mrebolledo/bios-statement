<?php

namespace App\Http\DataTable\Controllers;

use App\App\Controllers\Controller;
use App\App\Controllers\DataTableAbstract;
use App\Domain\Client\Collaborator\Collaborator;
use Illuminate\Http\Request;

class CollaboratorDataTableController extends DataTableAbstract
{
    public function getRecords()
    {
        return Collaborator::with('enterprise','type')->get();
    }

    public function map($record): array
    {
        return [
            $record->identifier,
            $record->first_name,
            $record->last_name,
            $record->type->name,
            $record->enterprise->name,
            $record->phone,
            $record->email,
            $this->getOptionButtons($record->id)
        ];
    }
}
