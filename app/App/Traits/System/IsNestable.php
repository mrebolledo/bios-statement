<?php

namespace App\App\Traits\System;

use App\Domain\System\Menu\Menu;

trait IsNestable
{

    public static  function generateMenu()
    {
        $menus = self::getNested();
        return view('app.components.menu.nav',compact('menus'));
    }


    public static function getNested($parent = null){
        $menus = static::getMenu();
        $filtered =$menus->filter(function ($value, $key) use ($parent) {
            return $value->parent_id == $parent;
        });

        $menu = array();
        foreach ($filtered as $f){
            $item = array ();
            if(!isset($f->permission)) {
                $can  = true;
            } else {
                $can = auth()->user()->hasPermissionTo($f->permission);
            }
            if ($can ) {
                $item = $f->toArray();

                $item['children'] = static::getNested($f['id']);
                if (isActiveRoute($f->route) && $f->route != null) {
                    $item['class'] = 'active';
                } else {
                    $item['class'] = '';
                }
                if (count($item['children']) > 0) {
                    foreach ($item['children'] as $child) {
                        if ($child['class'] == 'active') {
                            $item['class'] = 'open active';
                        }
                    }
                    $permissions = collect($item['children'])->pluck('permission')->toArray();
                } else {
                    $permissions = true;
                }
                if($permissions || auth()->user()->hasAnyPermission($permissions)) {
                    array_push($menu, $item);
                }

            }
        }
        return $menu;
    }


}
