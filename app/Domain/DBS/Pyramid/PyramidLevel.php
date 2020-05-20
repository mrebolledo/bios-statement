<?php

namespace App\Domain\DBS\Pyramid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PyramidLevel extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at','updated_at','deleted_at'];

    protected $fillable = [
        'pyramid_id',
        'name',
        'position',
        'created_at',
        'updated_at',
    ];

    public function pyramid()
    {
        return $this->belongsTo(Pyramid::class,'pyramid_id','id');
    }

    public function sectors()
    {
        return $this->hasMany(Sector::class,'level_id', 'id');
    }
}
