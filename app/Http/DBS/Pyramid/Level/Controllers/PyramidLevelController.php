<?php

namespace App\Http\DBS\Pyramid\Level\Controllers;

use App\App\Controllers\AbstractController;
use App\Domain\DBS\Pyramid\Pyramid;
use App\Domain\DBS\Pyramid\PyramidLevel;
use Illuminate\Http\Request;

class PyramidLevelController extends AbstractController
{
    public $icon = 'fa-sitemap';

    public $middle = true;

    public function __construct(Request $request)
    {
        parent::__construct();

        $pyramid = Pyramid::findOrFail($request->filter);
        $this->request = $request;
        $this->back = route('pyramids.index');
        $this->setTitle('Niveles de Pirámide: '.$pyramid->name);
    }

    public function entity()
    {
        return PyramidLevel::class;
    }

    public function entityPath()
    {
        return 'maintainers.DBS.pyramid.level';
    }

    public function getColumns(): array
    {
        return [
            'Nombre',
            'Sectores',
            'Acciones'
        ];
    }

    public function requiredVars()
    {
        return [
            'pyramid_id' => $this->request->filter
        ];
    }

    public function validation()
    {
        return [
            'name' => 'required'
        ];
    }

    public function getExtraButtons(): array
    {
        if (auth()->user()->hasPermissionTo('pyramid-levels.serialization')) {
            return [
                makeRemoteLink(route('pyramid-levels.serialization',['filter' => $this->request->filter]),'Serializar','fa-list-ol','btn-default','btn-sm')
            ];
        }

        return parent::getExtraButtons();
    }
}
