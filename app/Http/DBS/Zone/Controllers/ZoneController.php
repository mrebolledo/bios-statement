<?php

namespace App\Http\DBS\Zone\Controllers;

use App\App\Controllers\AbstractController;
use App\Domain\DBS\Pyramid\Zone;
use Illuminate\Http\Request;

class ZoneController extends AbstractController
{
    public $title = 'Zonas';

    public $middle = true;

    public function entity()
    {
        return Zone::class;
    }

    public function entityPath()
    {
        return 'maintainers.DBS.zone';
    }

    public function getColumns(): array
    {
        return [
            'Nombre',
            'Nombre Corto'
        ];
    }

    public function validation()
    {
        return [
            'name' => 'required',
            'short_name' => 'required'
        ];
    }
}
