<?php

namespace App\Http\Client\Enterprise\Controllers;

use App\App\Controllers\AbstractController;
use App\App\Controllers\Controller;
use App\Domain\Client\Enterprise\Enterprise;
use App\Rules\IsValidRut;
use Illuminate\Http\Request;

class EnterpriseController extends AbstractController
{
    public $title = 'Empresas';

    public $icon = 'fa-suitcase';

    public $middle = true;

    public function entity()
    {
        return Enterprise::class;
    }

    public function getColumns(): array
    {
        return [
            'RUT',
            'Nombre',
            'Email',
            'Telefono',
            'Representante',
            'Coordinador AS',
            'Email AS',
            'Colaboradores',
            'Acciones'
        ];
    }

    public function entityPath()
    {
        return 'maintainers.client.enterprise';
    }

    public function validation()
    {
        return [
            'rut' => ['required',new IsValidRut()],
            'name' => 'required',
            'phone' => 'required|max:9|min:9',
            'email' => 'required|email',
            'representative' => 'required',
            'principal_name' => 'required',
            'principal_email' => 'required|email'
        ];
    }
}
