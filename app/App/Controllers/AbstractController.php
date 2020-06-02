<?php

namespace App\App\Controllers;


use App\App\Traits\Controllers\HasEntity;
use App\App\Traits\Controllers\HasTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class AbstractController extends Controller
{
    use HasEntity,HasTitle;

    public $icon;

    public $filter = '';

    public $middle = false;

    public $request;

    public $back;

    public $extra_buttons = [];

    public $action_column = true;

    public function __construct()
    {
        $this->entity = $this->resolveEntity();

        if($this->middle) {
            $this->middleware(['permission:'.$this->getEntityName().'.view']);
        }
    }

    public abstract function getColumns():array ;
    public abstract function entityPath();


    public function index()
    {
        return view('app.CRUD.index', [
            'columns' => $this->resolveColumns(),
            'entity' => $this->getEntityName(),
            'title' => $this->makeTitle(),
            'icon' => $this->icon ?? 'fa-database',
            'filter' => $this->filter,
            'back' => $this->back ?? url()->previous(),
            'extra_buttons' => $this->getExtraButtons()
        ]);
    }

    public function resolveColumns()
    {
        if ($this->action_column) {
            $array = $this->getColumns();
            array_push($array,'Acciones');
            return $array;
        }
        return $this->getColumns();
    }

    public function getExtraButtons() : array
    {
        return $this->extra_buttons;
    }

    public function create(Request $request)
    {
        $this->beforeCreate();

        if($request->has('filter')) {
            $filter = $request->filter;
        } else {
            $filter = '';
        }

        return view($this->entityPath().'.form',array_merge([
            'entity' => $this->getEntityName(),
            'title' => 'Crear '.$this->makeTitle(),
            'icon' => $this->icon ?? 'fa-database',
            'is_edit' => false,
            'filter' => $filter
        ],$this->requiredVars()));
    }

    public function store(Request $request)
    {
        $request->validate($this->validation());

        $this->beforeStore($request);
        if ($record = $this->storeEntity($request)) {
            if($this->afterStore($request,$record)) {
                return $this->getResponse('success.store');
            }
        }

        return $this->getResponse('error.store');
    }

    protected function storeEntity(Request $request)
    {
        return $this->entity->create($request->all());
    }

    public function update(Request $request,$id)
    {
        $request->validate($this->validation());
        $this->beforeUpdate($request);
        if($record = $this->updateEntity($request,$id)) {
            $this->afterUpdate($request,$record);
            return $this->getResponse('success.update');
        } else {
            return $this->getResponse('error.update');
        }
    }

    protected function updateEntity(Request $request,$id)
    {
        return $this->entity->findOrFail($id)->update($request->all());
    }

    protected function afterUpdate(Request $request,$record)
    {
        return true;
    }

    protected function beforeUpdate(Request $request)
    {
        return true;
    }

    protected function beforeStore(Request $request)
    {
        return true;
    }

    protected function afterStore(Request $request, $record)
    {
        return true;
    }

    protected function beforeCreate()
    {
        return true;
    }

    public function requiredVars()
    {
        return [];
    }

    public function edit(Request $request,$id)
    {
        $this->beforeEdit();

        if($request->has('filter')) {
            $filter = $request->filter;
        } else {
            $filter = '';
        }
        return view($this->entityPath().'.form',array_merge([
            'entity' => $this->getEntityName(),
            'title' => 'Modificar '.$this->makeTitle(),
            'icon' => $this->icon ?? 'fa-database',
            'is_edit' => true,
            "record" => $this->entity->findOrFail($id),
            'filter' => $filter
        ],$this->requiredVars()));
    }

    public function destroy($id)
    {
        if ($this->beforeDestroy($id)) {
            if ($this->entity->findOrFail($id)->delete()) {
                return $this->getResponse('success.destroy');
            } else {
                return $this->getResponse('error.destroy');
            }
        } else {
            return response()->json(['error' => 'No pudo ser eliminado'],401);
        }
    }

    public function validation()
    {
        return [];
    }

    protected function beforeDestroy($id)
    {
        return true;
    }

    protected function beforeEdit()
    {
        return true;
    }

}
