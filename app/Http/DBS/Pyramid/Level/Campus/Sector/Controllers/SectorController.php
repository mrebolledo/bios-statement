<?php

namespace App\Http\DBS\Pyramid\Level\Campus\Sector\Controllers;

use App\App\Controllers\AbstractController;
use App\Domain\DBS\Pyramid\Campus;
use App\Domain\DBS\Pyramid\Sector;
use Illuminate\Http\Request;

class SectorController extends AbstractController
{
    public $icon = 'fa-sitemap';

    public $middle = true;

    public function __construct(Request $request)
    {
        parent::__construct();

        $campus = Campus::findOrFail($request->filter);
        $this->request = $request;
        $this->back = route('campuses.index',['filter' => $campus->level_id]);
        $this->setTitle('Sectores Plantel: '.$campus->name);
    }

    public function entity()
    {
        return Sector::class;
    }

    public function entityPath()
    {
        return 'maintainers.DBS.pyramid.level.campus.sector';
    }

    public function getColumns(): array
    {
        return [
            'Nombre',
            'Acciones'
        ];
    }

    public function requiredVars()
    {
        return [
            'campus_id' => $this->request->filter
        ];
    }

    public function validation()
    {
        return [
            'name' => 'required'
        ];
    }
}
