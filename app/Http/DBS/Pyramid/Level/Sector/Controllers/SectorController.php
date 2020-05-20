<?php

namespace App\Http\DBS\Pyramid\Level\Sector\Controllers;

use App\App\Controllers\AbstractController;
use App\Domain\DBS\Pyramid\PyramidLevel;
use App\Domain\DBS\Pyramid\Sector;
use App\Domain\DBS\Pyramid\Zone;
use Illuminate\Http\Request;

class SectorController extends AbstractController
{
    public $icon = 'fa-sitemap';

    public $middle = true;

    public function __construct(Request $request)
    {
        parent::__construct();

        $level = PyramidLevel::findOrFail($request->filter);
        $this->request = $request;
        $this->back = route('pyramid-levels.index',['filter' => $level->level_id]);
        $this->setTitle('Sectores Nivel: '.$level->name);
    }

    public function entity()
    {
        return Sector::class;
    }

    public function entityPath()
    {
        return 'maintainers.DBS.pyramid.level.sector';
    }

    public function getColumns(): array
    {
        return [
            'Nombre',
            'Zona',
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
