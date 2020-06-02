<?php

namespace App\Domain\DBS\Pyramid;

use App\Domain\System\User\User;
use Illuminate\Database\Eloquent\Model;

class PyramidConfiguration extends Model
{
    protected $fillable = [
        'pyramid_id',
        'modifier_id',
        'another_pyramid',
        'level_up',
        'level_down',
        'another_zone',
        'created_at',
        'updated_at'
    ];

    public function pyramid()
    {
        return $this->belongsTo(Pyramid::class,'pyramid_id','id');
    }

    public function modifier()
    {
        return $this->belongsTo(User::class,'modifier_id','id');
    }
}
