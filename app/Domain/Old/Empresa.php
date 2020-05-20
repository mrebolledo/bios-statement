<?php

namespace App\Domain\Old;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public $timestamps = false;

    protected $connection= 'bioseguridad';

    public $primaryKey  = 'EmpresaRut';

    protected $table = 'bioseguridad.empresa';
}
