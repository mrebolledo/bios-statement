<?php

namespace App\App\Traits\DBS\Pyramid;

use App\Domain\DBS\Pyramid\Pyramid;

trait HasZoneIntegrations
{
    protected function resolveZonesIntegrations($pyramid,$config)
    {
        $zones = Pyramid::with('levels.sectors.zone')->findOrFail($pyramid->id)->levels->map(function($level) {
            return $level->sectors->map(function($sector) {
                return $sector->zone;
            });
        })->collapse()->unique('id');
        foreach($zones as $zone) {
            foreach($zones as $z) {
                if($z->id !== $zone->id) {
                    if(!$this->integrateZone($zone,$z,$pyramid->id,$config->another_zone)) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    public function integrateZone($zone,$destination,$pyramid,$empty_nights)
    {
        return $zone->integrations()->updateOrCreate(
            [
                'destination_zone_id' => $destination->id,
                'pyramid_id' => $pyramid
            ],
            [
                'empty_nights' => $empty_nights,
                'modifier_id' => auth()->user()->id
            ]
        );
    }
}
