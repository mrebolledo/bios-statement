<?php

namespace App\Http\System\Permission\Controllers;

use App\App\Controllers\AbstractController;
use App\App\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends AbstractController
{
    public $title = 'Permisos';

    public $icon = 'fa-key';

    public $middle = true;

    public function entity()
    {
        return Permission::class;
    }

    public function entityPath()
    {
        return 'system.permission';
    }

    public function getColumns(): array
    {
        return [
            'Nombre',
            'Fecha de Creación',
            'Acciones'
        ];
    }

    protected function storeEntity(Request $request)
    {
        return Permission::create($request->all());
    }

    protected function beforeDestroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->roles()->detach();
        $permission->users()->detach();

        return true;
    }
}
