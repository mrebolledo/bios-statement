<?php

namespace App\Domain\DBS\Movement;

use App\Domain\Client\Collaborator\Collaborator;
use App\Domain\DBS\Pyramid\Sector;
use Illuminate\Database\Eloquent\Model;

class CollaboratorMovement extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'collaborator_id',
        'sector_id',
        'check_in_date',
        'check_in_time',
        'departure_date',
        'departure_time',
        'entered',
        'reason'
    ];

    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
