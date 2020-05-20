<?php

namespace App\Domain\Client\Collaborator;

use App\Domain\Client\Enterprise\Enterprise;
use App\Domain\Client\Extra\Statement\CollaboratorStatement;
use App\Domain\System\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collaborator extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $timestamps = false;

    protected $fillable = [
        'identifier',
        'first_name',
        'last_name',
        'enterprise_id',
        'phone',
        'email',
        'is_auth',
        'user_id',
        'type_id',
        'last_access',// que sector
        'access_start',
        'access_end'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function type()
    {
        return $this->belongsTo(CollaboratorType::class,'type_id','id');
    }

    public function scopeIdentifier($query,$identifier)
    {
        return $query->where('identifier',$identifier);
    }

    public static function findByIdentifier($identifier)
    {
        return static::identifier($identifier)->first();
    }

    public function statements()
    {
        return $this->hasMany(CollaboratorStatement::class,'collaborator_id','id');
    }

    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class,'enterprise_id','id');
    }
}
