<?php

namespace App\Http\Datatable\Controllers;

use App\App\Controllers\Controller;
use App\App\Controllers\DataTableAbstract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionDataTableController extends DataTableAbstract
{
    public function map($record): array
    {
        return [
            $record->name,
            Carbon::parse($record->created_at)->toDateString(),
            $this->getOptionButtons($record->id)
        ];
    }

    public function getRecords()
    {
        return Permission::orderBy('name')->get();
    }
}
