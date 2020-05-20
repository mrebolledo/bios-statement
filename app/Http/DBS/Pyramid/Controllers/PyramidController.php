<?php

namespace App\Http\DBS\Pyramid\Controllers;

use App\App\Controllers\AbstractController;
use App\App\Controllers\Controller;
use App\Domain\DBS\Pyramid\Pyramid;
use Illuminate\Http\Request;

class PyramidController extends AbstractController
{
    public $title = 'Pirámides';

    public $icon = 'fa-sitemap';

    public $middle = true;

    public function entity()
    {
        return Pyramid::class;
    }

    public function entityPath()
    {
        return 'maintainers.DBS.pyramid';
    }

    public function getColumns(): array
    {
        return [
            'Nombre',
            'Fecha de creación',
            'Niveles',
            'Acciones'
        ];
    }

    public function validation()
    {
        return [
            'name' => 'required',
        ];
    }
}
