<?php

namespace App\Domain\DBS\Pyramid;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Domain\Client\Collaborator\Collaborator;
use App\Domain\Client\Collaborator\CollaboratorSector;
use App\Domain\DBS\Authorization\Authorization;
use App\Domain\DBS\Movement\CollaboratorMovement;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'level_id',
        'zone_id',
        'name',
        'position',
        'grd_id'
    ];

    public function level()
    {
        return $this->belongsTo(PyramidLevel::class,'level_id','id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class,'zone_id','id');
    }

    public function collaborators()
    {
        return $this->hasMany(CollaboratorSector::class);
    }

    public function accesses()
    {
        return $this->hasMany(CollaboratorMovement::class,'sector_id','id');
    }
}
