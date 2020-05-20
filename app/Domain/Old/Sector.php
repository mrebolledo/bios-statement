<?php

namespace App\Domain\Old;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public $timestamps = false;

    protected $connection= 'bioseguridad';

    public $primaryKey  = 'SectorId';

    protected $table = 'bioseguridad.sector';
}
