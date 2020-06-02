<?php

namespace App\App\Traits\DBS\Pyramid;


use App\Domain\DBS\Pyramid\Pyramid;
use App\Domain\DBS\Pyramid\PyramidLevel;

trait HasLevelIntegrations
{
    protected function resolveLevelsIntegrations($pyramid,$config)
    {
        $levels = Pyramid::with('levels')->findOrFail($pyramid->id)->levels;

        foreach ($levels as $level) {
            foreach($levels as $l) {
                if($l->id !== $level->id) {
                    if(!$this->integrateLevelWithDefaults($level,$l,$config)) {
                        return false;
                    }
                }
            }
        }

        return true;
    }

    public function resolveLevelIntegration($pyramid_level,$config)
    {
        $levels = PyramidLevel::where('pyramid_id',$pyramid_level->pyramid_id)
                                ->where('id','<>',$pyramid_level->id)
                                ->get();

        foreach($levels as $level) {
            if(!$this->integrateLevelWithDefaults($pyramid_level,$level,$config)) {
                return false;
            } else {
                if(!$this->integrateLevelWithDefaults($level,$pyramid_level,$config)) {
                    return false;
                }
            }
        }

        return true;
    }

    public function integrateLevelWithDefaults($level,$destination,$config)
    {
        if($level->position > $destination->position ) {
            $empty_nights = $config->level_up;
        } else {
            $empty_nights = $config->level_down;
        }
        if(!$this->integrateLevel($level,$destination,$empty_nights)) {
            return false;
        }

        return true;
    }

    protected function integrateLevel($level,$destination,$empty_nights)
    {
        return $level->integrations()->updateOrCreate(
            ['destination_level_id' => $destination->id],
            [
                'empty_nights' => $empty_nights,
                'modifier_id' => auth()->user()->id
            ]
        );
    }
}
