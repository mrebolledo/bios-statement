<?php

namespace App\Http\System\Role\Controllers;

use App\App\Controllers\AbstractController;
use App\App\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends AbstractController
{
    public $title = 'Roles';

    public $middle = true;

    public function entity()
    {
        return Role::class;
    }

    public function entityPath()
    {
        return 'system.role';
    }

    public function getColumns(): array
    {
        return [
            'Nombre',
            'Fecha de Creación',
            'Acciones',
        ];
    }

    public function validation()
    {
        return [
            'name' => 'required|unique:roles,name'
        ];
    }

    protected function beforeDestroy($id)
    {
        $role = Role::findOrFail($id);
        $role->users()->detach();
        $role->permissions()->detach();

        return true;
    }
}
