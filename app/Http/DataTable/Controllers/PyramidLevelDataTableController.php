<?php

namespace App\Http\DataTable\Controllers;

use App\App\Controllers\Controller;
use App\App\Controllers\DataTableAbstract;
use App\Domain\DBS\Pyramid\PyramidLevel;
use Illuminate\Http\Request;

class PyramidLevelDataTableController extends DataTableAbstract
{
    public function getRecords()
    {
        return PyramidLevel::where('pyramid_id',$this->filter)->withCount('sectors')->orderBy('position')->get();
    }

    public function map($record): array
    {
        return [
            $record->name,
            $record->short_name,
            $record->sectors_count,
            $this->getOptionButtons($record)
        ];
    }

    public function getOptionButtons($record)
    {
        $user = auth()->user();
        $id = $record->id;
        if ($user->hasAnyPermission([
            'pyramid-levels.edit','pyramid-levels.delete','sectors.view'
        ])) {
            if($user->hasPermissionTo('sectors.view')) {
                $permissionsButton =  makeLink(route('sectors.index',['filter' => $id]),'Sectores','fa-sitemap','btn-primary','btn-md','true');
            }
            if($user->hasPermissionTo('sectors.view')) {
                $permissionsButton =  makeLink(route('sectors.index',['filter' => $id]),'Sectores','fa-sitemap','btn-primary','btn-md','true');
            }
            return makeGroupedLinks(array_merge($this->getDefaultOptions($id),[
                $permissionsButton ?? ''
            ]));
        }
    }
}
