<?php

namespace App\Domain\DBS\Pyramid;

use App\Domain\DBS\Pyramid\Integration\ZoneIntegration;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'short_name'
    ];

    protected $appends = ['full_name'];

    public function sectors()
    {
        return $this->hasMany(Sector::class,'zone_id','id');
    }

    public function integrations()
    {
        return $this->hasMany(ZoneIntegration::class,'zone_id','id');
    }

    public function getFullNameAttribute()
    {
        return $this->short_name.' - '.$this->name;
    }
}
