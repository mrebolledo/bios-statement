<?php

namespace App\Domain\Client\Collaborator;

use App\Domain\DBS\Authorization\Authorization;
use App\Domain\DBS\Pyramid\Sector;
use Illuminate\Database\Eloquent\Model;

class CollaboratorSector extends Model
{
    protected $table = 'collaborator_sector';

    protected $guarded = [];

    public function authorizations()
    {
        return $this->hasMany(Authorization::class,'collaborator_sector_id','id');
    }

    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }
}
