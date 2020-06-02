<?php

namespace App\App\Traits\DBS\Collaborator;

use App\Domain\Client\Collaborator\Collaborator;
use App\Domain\DBS\Pyramid\Sector;
use Carbon\Carbon;

trait HasMovements
{
    protected function checkMovement(Collaborator $collaborator,Sector $sector,$check_in)
    {
        $last_movement = $collaborator->movements->where('entered',1)->sortByDesc('id')->first();

        if($last_movement) {
            //check authorization
            $authorization = $this->checkAuthorization($collaborator);
            if($authorization !== true) {
                return $authorization;
            }
            //check Sector Authorization
            $sector_auth = $this->checkSectorAuthorization($collaborator,$sector);
            if($sector_auth  !== true) {
                return $sector_auth;
            }
            //check Rules
            $rules = $this->checkRules($sector,$last_movement,$check_in);
            if($rules !== true) {
                return $rules;
            }
        }

        return true;
    }

    protected function checkSectorAuthorization($collaborator,$sector)
    {
        $access = $collaborator->accesses->where('sector_id',$sector->id)->first();
        if(!$access) {
            return 'No posee acceso al sector';
        }

        $authorization = $access->authorizations->where('is_valid',1)->sortBy('priority')->first();
        if(!$authorization) {
            return 'No posee permisos vigentes para entrar al sector';
        }

        if ($authorization->gives_access === 0) {
           return $this->resolveAuthorizationMessage($authorization->type);
        }

        return true;
    }

    protected function resolveAuthorizationMessage($type)
    {
        $message = 'Se ha restringido su acceso: ';
        switch($type) {
            case 'from-collaborator-permissions' :
                return $message.'desde el mantenedor de los sectores del colaborador.';
                break;
            case 'from-quarantine':
                return $message. 'por cuarentena. ';
                break;
            default:
                return 'Se ha restringido su acceso al sector';
                break;
        }
    }

    protected function checkAuthorization($collaborator)
    {
        if($collaborator->access_expires != null) {
            if(strtotime($collaborator->access_expires) < strtotime(Carbon::today()->toDateString())) {
                return 'Su permiso ha expirado';
            }
        } else {
            return 'No autorizado';
        }
        return true;
    }

    protected function checkRules($sector,$last_movement,$check_in)
    {
        $rules = array();
        $pyramid_integrations = $sector->level->pyramid->integrations;
        $level_integrations = $sector->level->integrations;
        $zone_integrations = $sector->zone->integrations->where('pyramid_id',$sector->level->pyramid_id);
        if($last_movement->sector->level->pyramid_id != $sector->level->pyramid_id ) {
            array_push($rules,[
                'movement' => 'another_pyramid',
                'empty_nights' => $this->getPyramidEmptyNights($pyramid_integrations,$last_movement->sector->level->pyramid_id)
            ]);
        } else {
            if ($last_movement->sector->level_id != $sector->level_id) {
                array_push($rules,[
                    'movement' => 'another_level',
                    'empty_nights' => $this->getLevelEmptyNights($level_integrations,$last_movement->sector->level_id)
                ]);
            }

            if ($last_movement->sector->zone_id != $sector->zone_id) {
                array_push($rules,[
                    'movement' => 'another_zone',
                    'empty_nights' => $this->getZoneEmptyNights($zone_integrations,$last_movement->sector->zone_id)
                ]);
            }
        }
        $rule_to_apply = collect($rules)->sortByDesc('empty_nights')->first();
        if(count($rules) > 0) {
            if(Carbon::parse($check_in)->diffInDays(Carbon::parse($last_movement->departure_date)) <= $rule_to_apply['empty_nights']) {
                return  $this->resolveMessage($rule_to_apply['movement']);
            }
        }
        return true;
    }

    protected function getPyramidEmptyNights($integrations,$destination)
    {
        return $this->getEmptyNights($integrations,'destination_pyramid_id',$destination);
    }

    protected function getLevelEmptyNights($integrations,$destination)
    {
        return $this->getEmptyNights($integrations,'destination_level_id',$destination);
    }

    protected function getZoneEmptyNights($integrations,$destination)
    {
        return $this->getEmptyNights($integrations,'destination_zone_id',$destination);
    }

    protected function getEmptyNights($integrations,$field,$destination)
    {
        return $integrations->where($field,$destination)->first()->empty_nights;
    }

    protected function resolveMessage($movement)
    {
        $message = 'No cumple con noches de vacío por: ';
        switch ($movement) {
            case 'another_pyramid':
                return $message.'Cambio de especie.';
            break;
            case 'another_level':
                return $message.'Cambio de Nivel';
            break;
            case 'another_zone':
                return $message. 'Cambio de Zona';
                break;
        }
    }
}
