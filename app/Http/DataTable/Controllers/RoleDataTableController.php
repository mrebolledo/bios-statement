<?php

namespace App\Http\Datatable\Controllers;

use App\App\Controllers\DataTableAbstract;

class RoleDataTableController extends DataTableAbstract
{
    public function map($record): array
    {
        return [
            $record->name,
            $record->created_at,
            $this->getOptionButtons($record->id)
        ];
    }

    public function getOptionButtons($id)
    {
        $user = auth()->user();
        if ($user->hasAnyPermission([
            'roles.edit','roles.delete','roles.permissions'
        ])) {
            if($user->hasPermissionTo('roles.permissions')) {
                $permissionsButton =  makeRemoteLink(route('roles.permissions',['id' => $id]),'Permisos','fa-key','btn-primary','btn-md','true');
            }
            return makeGroupedLinks(array_merge($this->getDefaultOptions($id),[
                $permissionsButton ?? ''
            ]));
        }
    }
}
