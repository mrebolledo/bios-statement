<?php

namespace App\Domain\DBS\Pyramid\Integration;

use App\Domain\DBS\Pyramid\Pyramid;
use App\Domain\DBS\Pyramid\Zone;
use App\Domain\System\User\User;
use Illuminate\Database\Eloquent\Model;

class ZoneIntegration extends Model
{
    protected $fillable = [
        'pyramid_id',
        'zone_id',
        'destination_zone_id',
        'modifier_id',
        'empty_nights',
        'created_at',
        'updated_at'
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class,'zone_id','id');
    }

    public function destination()
    {
        return $this->belongsTo(Zone::class,'destination_zone_id','id');
    }

    public function modifier()
    {
        return $this->belongsTo(User::class,'modifier_id','id');
    }

    public function pyramid()
    {
        return $this->belongsTo(Pyramid::class,'pyramid_id','id');
    }
}
