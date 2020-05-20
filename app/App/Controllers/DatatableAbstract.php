<?php

namespace App\App\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

abstract class DataTableAbstract extends Controller
{
    public $filter;

    public $entity = false;

    public abstract function map($record): array;

    public  function getRecords()
    {
        return DB::table(Str::slug($this->entity,'_'))->get();
    }


    public function getData(Request $request,$entity)
    {
        $this->entity = $entity;
        if($request->has('filter')) {
            $this->filter = $request->filter;
        }
        $records = $this->getRecords();
        $data = array();
        $i = 1;

        if($this->getChecked()) {
            foreach ($records as $record) {
                $aux = $this->map($record);
                array_unshift($aux,$record->id);
                array_push($data,$aux);
            }
        } else {
            foreach ($records as $record) {
                $aux = $this->map($record);
                array_unshift($aux,$i);
                array_push($data,$aux);
                $i++;
            }
        }

        $json = array('data' => $data);
        return json_encode($json);
    }

    public function getOptionButtons($id)
    {
        if ($this->entity) {
           if(count($this->getDefaultOptions($id)) > 0){
               return makeGroupedLinks($this->getDefaultOptions($id));
           }
        }
        return  '-';
    }

    public function getDefaultOptions($id)
    {
        $user = auth()->user();
        $buttons = array();

        if($this->filter) {
            $filter = ['filter' => $this->filter];
        } else {
            $filter = [];
        }
        if ($user->hasAnyPermission([$this->entity.'.edit',$this->entity.'.delete'])) {
            if($user->hasPermissionTo($this->entity.'.edit')) {
                array_push($buttons,
                    makeEditButton(
                        route($this->entity.'.edit',array_merge([Str::slug(Str::singular($this->entity),'_') => $id], $filter))
                        ,true,
                        true)
                );
            }

            if($user->hasPermissionTo($this->entity.'.delete')) {
                array_push($buttons,
                    makeDeleteButton(
                        "Realmente desea eliminar el Registro?",
                        route($this->entity.'.destroy', array_merge([Str::slug(Str::singular($this->entity),'_') => $id], $filter)),
                        "'reload'",
                        true)
                );
            }

            return $buttons;
        } else {
            return [];
        }
    }

    public function getChecked()
    {
        return false;
    }
}
