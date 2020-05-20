<?php

namespace App\Domain\Old;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    public $timestamps = false;

    protected $connection= 'bioseguridad';

    public $primaryKey  = 'TrabajadorRut';

    protected $table = 'bioseguridad.trabajador';

}
