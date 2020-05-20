<?php

namespace App\Domain\DBS\Pyramid;

use App\Domain\DBS\Pyramid\PyramidLevel;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'level_id',
        'name',
        'position',
        'zone_id'
    ];

    public function level()
    {
        return $this->belongsTo(PyramidLevel::class,'level_id','id');
    }

    public function sectors()
    {
        return $this->hasMany(Sector::class,'campus_id','id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class,'zone_id','id');
    }
}
