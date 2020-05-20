<?php

namespace App\Http\System\Role\Controllers;

use App\App\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsController extends Controller
{
    public function index($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all()->groupBy(function($item) {
            return explode('.',$item->name)[0];
        });
        return view('system.role.permissions',compact('role','permissions'));
    }

    public function store(Request $request,$id)
    {
        $role = Role::findOrFail($id);

        $role->syncPermissions($request->permissions);

        return response()->json(['success','Permisos sincronizados']);
    }
}
