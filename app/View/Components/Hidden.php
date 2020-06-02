<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Hidden extends Component
{

    public $name;
    public $value;

    public function __construct($name, $value)
    {
        //
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.hidden');
    }
}
