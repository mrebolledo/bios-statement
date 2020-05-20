<?php

namespace App\App\Controllers;

use App\App\Traits\Controllers\HasEntity;
use App\App\Traits\Controllers\HasTitle;
use Illuminate\Http\Request;

abstract class SerializeAbstract extends Controller
{
    use HasEntity,HasTitle;

    public $middle;

    public $field;

    public $depth = 1;

    public $filter;

    public $has_children = false;

    public $field_serializable = 'position';

    public $parent_field_name = 'parent_id';

    public $filter_field;

    public function __construct()
    {
        $this->entity = $this->resolveEntity();
        if($this->middle) {
            $this->middleware(['permission:'.$this->getEntityName().'.serialization']);
        }
    }

    public function serializeView(Request $request)
    {
        if($request->has('filter')) {
            $this->filter = $request->filter;
        }

        return view('app.components.modals.serialize', [
            'entity' => $this->getEntityName(),
            'title' => $this->makeTitle(),
            'records' => $this->resolveRecords(),
            'depth' => $this->depth
        ]);
    }

    protected function  resolveRecords()
    {
        return $this->makeArray($this->getRecords());
    }

    protected function makeArray($rows,$parent = false) {
        $records = array();
        if (!$this->has_children) {
            foreach ($rows as $row) {
                array_push($records,[
                    'id' => $row->id,
                    'name' => $row->{$this->field}
                ]);
            }
        } else {
            if(!$parent) {
                $newRows = $rows->whereNull($this->parent_field_name);
            } else {
                $newRows = $rows->where($this->parent_field_name,$parent);
            }

            foreach($newRows as $row) {
                if(isset($row->children) && count($row->children) > 0) {
                    array_push($records,[
                        'id' => $row->id,
                        'name' => $row->{$this->field},
                        'children' => $this->makeArray($rows,$row->id)
                    ]);
                } else {
                    array_push($records,[
                        'id' => $row->id,
                        'name' => $row->{$this->field}
                    ]);
                }
            }
        }

        return $records;
    }

    protected function getRecords()
    {
        if(isset($this->filter) && $this->filter != '' ){
            if (method_exists($this->entity,'children')) {
                return $this->entity
                    ->where($this->filter_field,$this->filter)
                    ->with('children')
                    ->orderBy($this->field_serializable)
                    ->get();
            } else {
                return $this->entity
                    ->where($this->filter_field,$this->filter)
                    ->orderBy($this->field_serializable)
                    ->get();
            }
        } else {
            if (method_exists($this->entity,'children')) {
                return $this->entity
                    ->with('children')
                    ->orderBy($this->field_serializable)
                    ->get();
            } else {
                return $this->entity
                    ->orderBy($this->field_serializable)
                    ->get();
            }
        }
    }

    public function store(Request $request)
    {
        $records = json_decode($request->fields,true);

        $i = 0;
        foreach($records as $record) {
            $entity = $this->entity::find($record['id']);
            $entity->{$this->field_serializable} = $i;
            if($this->has_children) {
                $entity->parent_id = null;
            }
            $entity->save();

            $x = 0;
            if ( isset($record['children']) && count($record['children']) > 0) {
                foreach ($record['children'] as $second) {
                    $entity = $this->entity::find($second['id']);
                    $entity->{$this->field_serializable} = $x;
                    if($this->has_children) {
                        $entity->{$this->parent_field_name} = $record['id'];
                    }
                    $entity->save();
                    $z = 0;
                    if (isset($second['children']) && count($second['children']) > 0) {
                        foreach ($second['children'] as $third) {
                            $entity = $this->entity::find($third['id']);
                            $entity->{$this->field_serializable} = $z;
                            if($this->has_children) {
                                $entity->{$this->parent_field_name} = $second['id'];
                            }
                            $entity->save();
                            $z++;
                        }
                    }
                    $x++;
                }
            }
            $i++;
        }
        return response()->json(['success' => 'Serializado correctamente.']);
    }
}
