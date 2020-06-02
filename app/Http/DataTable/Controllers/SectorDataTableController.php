<?php

namespace App\Http\DataTable\Controllers;

use App\App\Controllers\DataTableAbstract;
use App\Domain\DBS\Pyramid\Sector;

class SectorDataTableController extends DataTableAbstract
{
    public function getRecords()
    {
        return Sector::with('level','zone')->where('level_id',$this->filter)->get();
    }

    public function map($record): array
    {
        return [
            $record->name,
            $record->grd_id,
            $record->zone->name,
            $this->getOptionButtons($record->id)
        ];
    }
}
