<?php

namespace App\Domain\Client\Enterprise;

use App\Domain\Client\Collaborator\Collaborator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enterprise extends Model
{
    use SoftDeletes;

    protected $dates =  ['created_at','updated_at','deleted_at'];

    protected $fillable = [
        'rut',
        'name',
        'email',
        'phone',
        'representative',
        'principal_name',
        'principal_email',
        'created_at',
        'updated_at'
    ];

    public function collaborators()
    {
        return $this->hasMany(Collaborator::class,'enterprise_id','id');
    }
}
