<?php

namespace App\Domain\DBS\Pyramid\Integration;

use App\Domain\DBS\Pyramid\PyramidLevel;
use App\Domain\System\User\User;
use Illuminate\Database\Eloquent\Model;

class LevelIntegration extends Model
{
    protected $fillable = [
        'level_id',
        'destination_level_id',
        'modifier_id',
        'empty_nights',
        'created_at',
        'updated_at'
    ];

    public function level()
    {
        return $this->belongsTo(PyramidLevel::class,'level_id','id');
    }

    public function destination()
    {
        return $this->belongsTo(PyramidLevel::class,'destination_level_id','id');
    }

    public function modifier()
    {
        return $this->belongsTo(User::class,'modifier_id','id');
    }
}
