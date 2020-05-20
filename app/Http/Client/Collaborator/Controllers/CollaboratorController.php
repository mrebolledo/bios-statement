<?php

namespace App\Http\Client\Collaborator\Controllers;

use App\App\Controllers\AbstractController;
use App\App\Controllers\Controller;
use App\Domain\Client\Collaborator\Collaborator;
use App\Domain\Client\Collaborator\CollaboratorType;
use App\Domain\Client\Enterprise\Enterprise;
use Illuminate\Http\Request;

class CollaboratorController extends AbstractController
{
    public $title = 'Colaboradores';

    public $icon = 'fa-user-tag';

    public $middle = true;

    public function entity()
    {
        return Collaborator::class;
    }

    public function getColumns(): array
    {
        return  [
            'Identificador',
            'Nombre',
            'Apellido',
            'Tipo',
            'Empresa',
            'Telefono',
            'Email',
            'Acciones'
        ];
    }

    public function entityPath()
    {
       return 'maintainers.client.collaborator';
    }

    public function requiredVars()
    {
        return [
            'types' => CollaboratorType::get(),
            'enterprises' => Enterprise::get()
        ];
    }

    public function validation()
    {
        return [
            'identifier' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'type_id' => 'required',
            'email' => 'email',
            'enterprise_id' => 'required',
        ];
    }
}
