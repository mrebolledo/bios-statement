<?php

namespace App\Domain\System\User;

use App\Domain\Client\Collaborator\Collaborator;
use App\Domain\DBS\Authorization\Authorization;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function collaborator()
    {
        return $this->hasOne(Collaborator::class,'user_id','id');
    }

    public function created_authorizations()
    {
        return $this->hasMany(Authorization::class,'creator_id','id');
    }

    public function authorizations()
    {
        return $this->morphMany(Authorization::class,'authorizable');
    }
}
