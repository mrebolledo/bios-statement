<?php

namespace App\Http\DataTable\Controllers;

use App\App\Controllers\Controller;
use App\App\Controllers\DataTableAbstract;
use Illuminate\Http\Request;

class ZoneDataTableController extends DataTableAbstract
{
    public function map($record): array
    {
        return [
            $record->name,
            $record->short_name,
            $this->getOptionButtons($record->id)
        ];
    }
}
