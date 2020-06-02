<?php

namespace App\App\Traits\DBS\Pyramid;

use App\Domain\DBS\Pyramid\Pyramid;

trait HasPyramidIntegrations
{
    use HasZoneIntegrations,HasLevelIntegrations;

    protected function resolvePyramidIntegrations($pyramid,$config)
    {
        $pyramids = Pyramid::where('id','<>',$pyramid->id)->get();

        foreach($pyramids as $p) {
            if(!$this->integratePyramid($pyramid,$p,$config->another_pyramid)) {
                return false;
            }
        }
        return true;
    }

    protected function integratePyramid($pyramid,$destination,$empty_nights)
    {
        return $pyramid->integrations()->updateOrCreate(
            ['destination_pyramid_id' => $destination->id],
            [
                'empty_nights' => $empty_nights,
                'modifier_id' => auth()->user()->id
            ]);
    }
}
