<?php

namespace App\Http\DBS\Pyramid\Level\Controllers;

use App\App\Controllers\Controller;
use App\App\Controllers\SerializeAbstract;
use App\App\Traits\DBS\Pyramid\HasLevelIntegrations;
use App\Domain\DBS\Pyramid\Pyramid;
use App\Domain\DBS\Pyramid\PyramidLevel;
use Illuminate\Http\Request;

class PyramidLevelSerializationController extends SerializeAbstract
{
    use HasLevelIntegrations;

    public $middle = true;

    public $filter_field = 'pyramid_id';

    public function __construct()
    {
        parent::__construct();
        $this->field = 'name';
    }

    public function entity()
    {
        return PyramidLevel::class;
    }

    protected function afterStore()
    {
        $pyramid = Pyramid::with('configuration')->find($this->filter);
        if ($pyramid->configuration) {
            return $this->resolveLevelsIntegrations($pyramid,$pyramid->configuration);
        }
        return true;
    }
}
