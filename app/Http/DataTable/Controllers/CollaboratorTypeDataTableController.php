<?php

namespace App\Http\DataTable\Controllers;

use App\App\Controllers\DataTableAbstract;

class CollaboratorTypeDataTableController extends DataTableAbstract
{
    public function map($record): array
    {
        return [
            $record->name,
            $this->getOptionButtons($record->id)
        ];
    }
}
