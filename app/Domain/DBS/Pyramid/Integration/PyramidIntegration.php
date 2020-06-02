<?php

namespace App\Domain\DBS\Pyramid\Integration;

use App\Domain\DBS\Pyramid\Pyramid;
use App\Domain\System\User\User;
use Illuminate\Database\Eloquent\Model;

class PyramidIntegration extends Model
{
    protected $fillable = [
        'pyramid_id',
        'destination_pyramid_id',
        'modifier_id',
        'empty_nights',
        'created_at',
        'updated_at'
    ];

    public function pyramid()
    {
        return $this->belongsTo(Pyramid::class,'pyramid_id','id');
    }

    public function destination()
    {
        return $this->belongsTo(Pyramid::class,'destination_pyramid_id','id');
    }

    public function modifier()
    {
        return $this->belongsTo(User::class,'modifier_id','id');
    }
}
