<?php

namespace App\Domain\Client\Extra\Statement;

use App\Domain\Client\Collaborator\Collaborator;
use Illuminate\Database\Eloquent\Model;

class CollaboratorStatement extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'collaborator_id',
        'statement_date',
        'verification_code',
        'statement_1',
        'statement_2',
        'statement_3',
        'statement_4',
        'can_enter',
        'reason'
    ];

    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class,'collaborator_id','id');
    }

    public function scopeCode($query,$code)
    {
        return $query->where('verification_code',$code);
    }

    public static function findByCode($code)
    {
        return static::code($code)->first();
    }
}
