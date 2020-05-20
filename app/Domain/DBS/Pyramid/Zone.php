<?php

namespace App\Domain\DBS\Pyramid;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function sectors()
    {
        return $this->hasMany(Sector::class,'zone_id','id');
    }
}
