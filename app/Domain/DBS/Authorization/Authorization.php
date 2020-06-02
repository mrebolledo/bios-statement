<?php

namespace App\Domain\DBS\Authorization;

use App\Domain\Client\Collaborator\CollaboratorSector;
use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    protected $fillable = [
        'creator_id',
        'collaborator_sector_id',
        'authorizable_id',
        'authorizable_type',
        'description',
        'type',
        'start_date',
        'end_date',
        'is_valid',
        'gives_access',
        'created_at',
        'updated_at'
    ];

    public function collaborator_sector()
    {
        return $this->belongsTo(CollaboratorSector::class,'collaborator_sector_id','id');
    }

    public function authorizable()
    {
        return $this->morphTo();
    }


}
