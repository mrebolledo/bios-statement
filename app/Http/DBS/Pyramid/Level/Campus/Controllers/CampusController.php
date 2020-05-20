<?php

namespace App\Http\DBS\Pyramid\Level\Campus\Controllers;

use App\App\Controllers\AbstractController;
use App\App\Controllers\Controller;
use App\Domain\DBS\Pyramid\Campus;
use App\Domain\DBS\Pyramid\PyramidLevel;
use App\Domain\DBS\Pyramid\Zone;
use Illuminate\Http\Request;

class CampusController extends AbstractController
{
    public $icon = 'fa-sitemap';

    public $middle = true;

    public function __construct(Request $request)
    {
        parent::__construct();

        $level = PyramidLevel::findOrFail($request->filter);
        $this->request = $request;
        $this->back = route('pyramid-levels.index',['filter' => $level->pyramid_id]);
        $this->setTitle('Planteles Nivel: '.$level->name);
    }

    public function entity()
    {
        return Campus::class;
    }

    public function entityPath()
    {
        return 'maintainers.DBS.pyramid.level.campus';
    }

    public function getColumns(): array
    {
        return [
            'Nombre',
            'Zona',
            'Sectores',
            'Acciones'
        ];
    }

    public function requiredVars()
    {
        return [
            'level_id' => $this->request->filter,
            'zones' => Zone::get()
        ];
    }

    public function validation()
    {
        return [
            'name' => 'required',
            'zone_id' => 'required'
        ];
    }
}
