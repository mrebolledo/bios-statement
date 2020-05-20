<?php

namespace App\Http\System\Test\Controllers;

use App\App\Controllers\Soap\InstanceSoapClient;
use App\App\Controllers\Soap\SoapController;
use App\Domain\Client\Collaborator\Collaborator;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends SoapController
{
    public function __invoke()
    {
        $date = Carbon::now()->subDays(7)->toDateString();
        $collaborator = Collaborator::with(['statements' => function ($query) {
            $query->orderBy('id', 'desc');
        }])->has('statements')->where('identifier', '15677792-7')->first();

        dd($collaborator,$collaborator->statements->first()->statement_date,Carbon::now()->toDateString(),Carbon::today()->diffInDays(Carbon::parse($collaborator->statements->first()->statement_date)->toDateString()),Carbon::parse($collaborator->statements->first()->statement_date)->toDateString());
    }
}
