<?php

namespace App\Http\Client\Extra;

use App\App\Controllers\Controller;
use App\Domain\Old\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdatePyramidToWorkers extends Controller
{
    public function __invoke()
    {
        $records = $this->getRecords();
        $workers = Trabajador::get();

        foreach($workers as $worker) {
            $record = collect($records)->where('estado', 1)->where('rut',$worker->TrabajadorRut)->first();
           if($record) {
               if($worker->pollos !== ($record->pollos != '')?1:null || $worker->cerdos !== ($record->cerdos != '')?1:null) {
                   $worker->pollos = ($record->pollos != '')?1:null;
                   $worker->cerdos = ($record->cerdos != '')?1:null;
                   $worker->save();
               }
           } else {
               $worker->pollos = null;
               $worker->cerdos = null;
               $worker->save();
           }
           unset($record);
        }

        echo 'Proceso OK! <br>';
        echo collect($records)->where('estado',1)->count().' Trabajadores actualizados';
    }

    protected function getRecords()
    {
        return DB::connection('bioseguridad')->select(DB::raw('
                        SELECT  
	                    trabajador.`TrabajadorRut` as rut,
	                    aut.max_id,
                        aut2.estado,
                        pollos.area as pollos,
                        cerdos.area as cerdos
                    FROM      trabajador
                    left JOIN      
                                (
                                  select    
                                    MAX(autorizacion.`AutorizacionId`) as  max_id,
                                    autorizacion.`TrabajadorRut` as rut
                                  from      autorizacion 
                                  group by  autorizacion.`TrabajadorRut`
                              
                                 ) aut on (aut.rut = trabajador.TrabajadorRut)
                    left JOIN      
                                (
                                  select    
                                    autorizacion.`AutorizacionId` as compare_id,
                                    autorizacion.`AutorizacionEst` as estado,
                                    autorizacion.`TrabajadorRut`
                                    from      autorizacion 
                              
                                 ) aut2 on (aut.max_id = aut2.compare_id)
                    left join 
                            (
                                select 
                                    autorizaciondetalle.`AutorizacionId` as aut_id,
                                    autorizaciondetalle.`AreaId` as area
                                from	
                                    autorizaciondetalle
                                where 
                                    autorizaciondetalle.`AreaId`= 1
                            ) pollos on (pollos.aut_id = aut2.compare_id)
                    left join 
                            (
                                select 
                                    autorizaciondetalle.`AutorizacionId` as aut_id,
                                    autorizaciondetalle.`AreaId` as area
                                from	
                                    autorizaciondetalle
                                where 
                                    autorizaciondetalle.`AreaId`= 2
                            ) cerdos on (cerdos.aut_id = aut2.compare_id)
                    group by rut'));
    }
}
