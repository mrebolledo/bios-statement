<?php

namespace App\Domain\System\Menu;


use App\App\Traits\System\IsNestable;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use IsNestable;

    protected $fillable = [
        'route','name','icon','parent_id','position','created_at','updated_at','permission'
    ];


    public function children()
    {
        return $this->hasMany(Menu::class,'parent_id','id');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class,'parent_id','id');
    }

    public static function getMenu()
    {
        return static::orderBy('position')->get();
    }

    public static function makeMenu()
    {
        return static::generateMenu();
    }
}
