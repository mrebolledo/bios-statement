<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Combo extends Component
{
    public $label;
    public $name;
    public $comparator;
    public $isEdit;
    public $entity;
    public $display;
    public $filter;
    public $filterField;
    public $idField;


    public function __construct($label,$name, $entity,$display,$comparator = false,$isEdit = false, $idField = 'id',$filter = false,$filterField = false)
    {
        $this->label = $label;
        $this->name = $name;
        $this->comparator = $comparator;
        $this->isEdit = $isEdit;
        $this->entity = $entity;
        $this->display = $display;
        $this->entity = $entity;
        $this->filter = $filter;
        $this->filterField = $filterField;
        $this->idField = $idField;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.combo');
    }

    public function list()
    {
        if($this->filter  && $this->filterField) {
            return DB::table(Str::slug($this->entity,'_'))->where($this->filterField,$this->filter)->get();
        } else {
            return DB::table(Str::slug($this->entity,'_'))->get();
        }
    }
}
