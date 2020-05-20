<?php

namespace App\Domain\DBS\Pyramid;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'level_id',
        'zone_id',
        'name',
        'position'
    ];

    public function level()
    {
        return $this->belongsTo(PyramidLevel::class,'level_id','id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class,'zone_id','id');
    }
}
