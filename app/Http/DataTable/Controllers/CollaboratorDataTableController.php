<?php

namespace App\Http\DataTable\Controllers;

use App\App\Controllers\Controller;
use App\App\Controllers\DataTableAbstract;
use App\Domain\Client\Collaborator\Collaborator;
use Illuminate\Http\Request;

class CollaboratorDataTableController extends DataTableAbstract
{
    public function getRecords()
    {
        return Collaborator::with('enterprise','type')->get();
    }

    public function map($record): array
    {
        return [
            $record->identifier,
            $record->first_name,
            $record->last_name,
            $record->type->name,
            $record->enterprise->name,
            $record->phone,
            $record->email,
            $this->getOptionButtons($record->id)
        ];
    }

    public function getOptionButtons($id)
    {
        $user = auth()->user();
        if ($user->hasAnyPermission([
            'collaborators.edit','collaborators.delete','collaborators.sectors','collaborators.manage'
        ])) {
            if($user->hasPermissionTo('collaborators.sectors')) {
                $sectorsButtons =  makeLink(route('collaborator.sectors',['collaborator' => $id]),'Sectores','fa-key','btn-primary','btn-md','true');
            }
            if($user->hasPermissionTo('collaborators.manage')) {
                $manageButton =  makeLink(route('collaborator.manage',['collaborator_id' => $id]),'Administrar','fa-cog','btn-primary','btn-md','true');
            }
            return makeGroupedLinks(array_merge($this->getDefaultOptions($id),[
                $sectorsButtons ?? '',
                $manageButton ?? '',
            ]));
        }
    }
}
