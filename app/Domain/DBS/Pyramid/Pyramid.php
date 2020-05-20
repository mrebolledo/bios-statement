<?php

namespace App\Domain\DBS\Pyramid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pyramid extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at','updated_at','deleted_at'];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];

    public function levels()
    {
        return $this->hasMany(PyramidLevel::class,'pyramid_id','id');
    }
}
