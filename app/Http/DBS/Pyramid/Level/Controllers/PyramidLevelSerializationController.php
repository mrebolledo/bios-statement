<?php

namespace App\Http\DBS\Pyramid\Level\Controllers;

use App\App\Controllers\Controller;
use App\App\Controllers\SerializeAbstract;
use App\Domain\DBS\Pyramid\PyramidLevel;
use Illuminate\Http\Request;

class PyramidLevelSerializationController extends SerializeAbstract
{
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
}
