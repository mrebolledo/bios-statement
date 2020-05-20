<?php

namespace App\Domain\Client\Collaborator;

use Illuminate\Database\Eloquent\Model;

class CollaboratorType extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function collaborators()
    {
        return $this->hasMany(Collaborator::class,'type_id','id');
    }
}
