<?php

namespace App\Http\DataTable\Controllers;

use App\App\Controllers\Controller;
use App\App\Controllers\DataTableAbstract;
use App\Domain\Client\Enterprise\Enterprise;
use Illuminate\Http\Request;

class EnterpriseDataTableController extends DataTableAbstract
{
    public function getRecords()
    {
        return Enterprise::withCount('collaborators')->get();
    }

    public function map($record): array
    {
        return [
            $record->rut,
            $record->name,
            $record->email,
            $record->phone,
            $record->representative,
            $record->principal_name,
            $record->principal_email,
            $record->collaborators_count,
            $this->getOptionButtons($record->id)
        ];
    }
}
