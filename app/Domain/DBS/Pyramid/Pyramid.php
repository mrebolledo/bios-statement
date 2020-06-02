<?php

namespace App\Domain\DBS\Pyramid;

use App\Domain\DBS\Pyramid\Integration\PyramidIntegration;
use App\Domain\DBS\Pyramid\Integration\ZoneIntegration;
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

    public function configuration()
    {
        return $this->hasOne(PyramidConfiguration::class,'pyramid_id','id');
    }

    public function integrations()
    {
        return $this->hasMany(PyramidIntegration::class,'pyramid_id','id');
    }

    public function integrated_zones()
    {
        return $this->hasMany(ZoneIntegration::class,'pyramid_id','id');
    }
}
