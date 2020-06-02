<?php

namespace App\Http\DBS\Pyramid\Controllers;

use App\App\Controllers\Controller;
use App\App\Traits\DBS\Pyramid\HasPyramidIntegrations;
use App\Domain\DBS\Pyramid\Pyramid;
use App\Domain\DBS\Pyramid\PyramidLevel;
use App\Domain\DBS\Pyramid\Zone;
use Illuminate\Http\Request;

class PyramidIntegrationsController extends Controller
{
    use HasPyramidIntegrations;

    public function __construct()
    {
        $this->middleware(['permission:pyramids.integrations']);
    }

    public function index($pyramid_id)
    {
        $pyramid = Pyramid::with([
            'configuration',
            'integrations.destination',
            'levels.integrations',
            'levels.sectors.zone.integrations'
            ])->findOrFail($pyramid_id);
        return view('dbs.pyramid.integrations', [
            'pyramid' => $pyramid
        ]);
    }

    public function pyramidToPyramid(Request $request)
    {
        $pyramid = Pyramid::findOrFail($request->pyramid_id);
        $destination = Pyramid::findOrFail($request->destination_id);
        if (!$this->integratePyramid($pyramid,$destination,$request->empty_nights)) {
           return response()->json(['error' => 'No se pudo integrar'],401);
        }
    }

    public function zoneToZone(Request $request)
    {
        $pyramid = Pyramid::findOrFail($request->pyramid_id);
        $zone = Zone::findOrFail($request->zone_id);
        $destination = Zone::findOrFail($request->destination_id);
        if (!$this->integrateZone($zone,$destination,$pyramid->id,$request->empty_nights)) {
            return response()->json(['error' => 'No se pudo integrar'],401);
        }
    }

    public function levelToLevel(Request $request)
    {
        $level = PyramidLevel::findOrFail($request->level_id);
        $destination = PyramidLevel::findOrFail($request->destination_id);
        if (!$this->integrateLevel($level,$destination,$request->empty_nights)) {
            return response()->json(['error' => 'No se pudo integrar'],401);
        }
    }
}
