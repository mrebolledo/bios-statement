<?php

namespace App\Http\System\Test\Controllers;

use App\App\Controllers\Soap\InstanceSoapClient;
use App\App\Controllers\Soap\SoapController;
use App\Domain\Client\Collaborator\Collaborator;
use App\Domain\DBS\Authorization\Authorization;
use App\Domain\DBS\Pyramid\Sector;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends SoapController
{
    public function __invoke()
    {
        $authorizations = Authorization::get();
        foreach($authorizations as $authorization) {
            $authorizations->priority = 5;
            $authorization->save();
        }
    }
}
