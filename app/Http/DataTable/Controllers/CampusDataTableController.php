<?php

namespace App\Http\DataTable\Controllers;

use App\App\Controllers\DataTableAbstract;
use App\Domain\DBS\Pyramid\Campus;
use Illuminate\Http\Request;

class CampusDataTableController extends DataTableAbstract
{
    public function getRecords()
    {
        return Campus::with('zone')->where('level_id',$this->filter)->withCount('sectors')->get();
    }

    public function map($record): array
    {
        return [
            $record->name,
            $record->zone->name,
            $record->sectors_count,
            $this->getOptionButtons($record->id)
        ];
    }

    public function getOptionButtons($id)
    {
        $user = auth()->user();

        if ($user->hasAnyPermission([
            'campuses.edit','campuses.delete','sectors.view'
        ])) {
            if($user->hasPermissionTo('sectors.view')) {
                $permissionsButton =  makeLink(route('sectors.index',['filter' => $id]),'Sectores','fa-sitemap','btn-primary','btn-md','true');
            }
            return makeGroupedLinks(array_merge($this->getDefaultOptions($id),[
                $permissionsButton ?? ''
            ]));
        }
    }
}
