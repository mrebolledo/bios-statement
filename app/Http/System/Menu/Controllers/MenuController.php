<?php

namespace App\Http\System\Menu\Controllers;

use App\App\Controllers\AbstractController;
use App\App\Controllers\Controller;
use App\Domain\System\Menu\Menu;
use App\Rules\IsValidRoute;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class MenuController extends AbstractController
{
    public $title = 'Menu';

    public $icon = 'fa-bars';

    public $middle = true;

    public function entity()
    {
        return Menu::class;
    }

    public function entityPath()
    {
        return 'system.menu';
    }

    public function getColumns(): array
    {
        return [
            'Icono',
            'Nombre',
            'Ruta',
            'Parent'
        ];
    }

    public function requiredVars()
    {
        return [
            'menus' => Menu::whereNotNull('icon')->orderBy('position')->get()
        ];
    }

    public function validation()
    {
        return [
            'name' => 'required',
            'route' => new IsValidRoute(),

        ];
    }

    public function getExtraButtons(): array
    {
        if (auth()->user()->hasPermissionTo('menus.serialization')) {
            return [
                makeRemoteLink(route('menus.serialization'),'Serializar','fa-list-ol','btn-default','btn-sm')
            ];
        }

        return parent::getExtraButtons();
    }
}
