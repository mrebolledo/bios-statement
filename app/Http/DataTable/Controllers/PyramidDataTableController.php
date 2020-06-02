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
        return Pyramid::with('configuration')->withCount('levels')->get();
    }

    public function map($record): array
    {
        return [
            $record->name,
            Carbon::parse($record->created_at)->toDateTimeString(),
            $record->levels_count,
            $this->getOptionButtons($record)
        ];
    }

    public function getOptionButtons($record)
    {
        $user = auth()->user();
        $id = $record->id;
        if ($user->hasAnyPermission([
            'pyramids.edit','pyramids.delete','pyramid-levels.view','pyramids.configuration'
        ])) {
            if($user->hasPermissionTo('pyramid-levels.view')) {
                $permissionsButton =  makeLink(route('pyramid-levels.index',['filter' => $id]),'Niveles','fa-sitemap','btn-primary','btn-md','true');
            }
            if($user->hasPermissionTo('pyramids.configuration') ) {
                $configurationButton =  makeRemoteLink(route('pyramids.configuration',['pyramid_id' => $id]),'Config','fa-cog','btn-primary','btn-md','true');
            }
            if($user->hasPermissionTo('pyramids.integrations') && $record->configuration) {
                $integrationsbutton =  makeLink(route('pyramids.integrations',['pyramid_id' => $id]),'Integraciones','fa-cogs','btn-primary','btn-md','true');
            }
            return makeGroupedLinks(array_merge($this->getDefaultOptions($id),[
                $permissionsButton ?? '',
                $configurationButton ?? '',
                $integrationsbutton ?? ''
            ]));
        }
    }
}
