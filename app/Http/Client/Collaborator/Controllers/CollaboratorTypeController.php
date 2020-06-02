<?php

namespace App\Http\Client\Collaborator\Controllers;

use App\App\Controllers\AbstractController;
use App\App\Controllers\Controller;
use App\Domain\Client\Collaborator\CollaboratorType;
use Illuminate\Http\Request;

class CollaboratorTypeController extends AbstractController
{
    public $title = 'Tipos de Colaboradores';

    public $middle = true;

    public function entity()
    {
        return CollaboratorType::class;
    }

    public function getColumns(): array
    {
        return [
            'Nombre'
        ];
    }

    public function entityPath()
    {
        return 'maintainers.client.collaborator.type';
    }
}
