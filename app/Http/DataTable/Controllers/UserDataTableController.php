<?php

namespace App\Http\Datatable\Controllers;

use App\App\Controllers\DataTableAbstract;
use App\Domain\System\User\User;
use Illuminate\Http\Request;

class UserDataTableController extends DataTableAbstract
{
    public function map($record):array
    {
        return [
            $record->first_name,
            $record->last_name,
            $record->email,
            $this->getOptionButtons($record->id)
        ];
    }
}
