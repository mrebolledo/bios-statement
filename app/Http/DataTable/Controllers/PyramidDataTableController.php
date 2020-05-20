<?php

namespace App\Http\DataTable\Controllers;

use App\App\Controllers\Controller;
use App\App\Controllers\DataTableAbstract;
use App\Domain\DBS\Pyramid\Pyramid;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PyramidDataTableController extends DataTableAbstract
{
    public function getRecords()
    {
        return Pyramid::withCount('levels')->get();
    }

    public function map($record): array
    {
        return [
            $record->name,
            Carbon::parse($record->created_at)->toDateTimeString(),
            $record->levels_count,
            $this->getOptionButtons($record->id)
        ];
    }

    public function getOptionButtons($id)
    {
        $user = auth()->user();

        if ($user->hasAnyPermission([
            'pyramids.edit','pyramids.delete','pyramid-levels.view'
        ])) {
            if($user->hasPermissionTo('pyramid-levels.view')) {
                $permissionsButton =  makeLink(route('pyramid-levels.index',['filter' => $id]),'Niveles','fa-sitemap','btn-primary','btn-md','true');
            }
            return makeGroupedLinks(array_merge($this->getDefaultOptions($id),[
                $permissionsButton ?? ''
            ]));
        }
    }
}
