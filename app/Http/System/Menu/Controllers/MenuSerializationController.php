<?php

namespace App\Http\System\Menu\Controllers;

use App\App\Controllers\Controller;
use App\App\Controllers\SerializeAbstract;
use App\Domain\System\Menu\Menu;
use Illuminate\Http\Request;

class MenuSerializationController extends SerializeAbstract
{
    public $depth = 3;

    public $has_children = true;

    public $middle = true;

    public function __construct()
    {
        parent::__construct();
        $this->field = 'name';
    }

    public function entity()
    {
        return Menu::class;
    }
}
