<?php

namespace App\Http\DBS\Collaborator\Controllers;

use App\App\Controllers\Controller;
use App\Domain\Client\Collaborator\Collaborator;
use Illuminate\Http\Request;

class CollaboratorManageController extends Controller
{
    public function index($collaborator_id)
    {
        $collaborator = Collaborator::findOrFail($collaborator_id);
        return view('dbs.collaborator.index',[
            'collaborator' => $collaborator,
            'columns' => $this->getColumns(),
        ]);
    }

    protected function getColumns()
    {
        return [
            'Pirámide',
            'Nivel',
            'Sector',
            'Zona',
            'Fecha de Entrada',
            'Hora',
            'Fecha de Salida',
            'Hora',
            'Permitido',
            'Razón'
        ];
    }
}
