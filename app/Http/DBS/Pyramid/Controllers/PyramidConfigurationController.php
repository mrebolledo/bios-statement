<?php

namespace App\Http\DBS\Pyramid\Controllers;

use App\App\Controllers\Controller;
use App\App\Traits\DBS\Pyramid\HasPyramidIntegrations;
use App\Domain\DBS\Pyramid\Pyramid;
use App\Domain\DBS\Pyramid\PyramidConfiguration;
use Illuminate\Http\Request;

class PyramidConfigurationController extends Controller
{
    use HasPyramidIntegrations;

    public function index($pyramid_id)
    {
        $pyramid = Pyramid::with('configuration')->findOrFail($pyramid_id);

        return view('dbs.pyramid.configuration',[
            'pyramid' => $pyramid,
            'requires_confirmation' => true
        ]);
    }

    public function store(Request $request,$pyramid_id)
    {
        $pyramid = Pyramid::with('configuration')->findOrFail($pyramid_id);
        if($config = PyramidConfiguration::updateOrCreate(['pyramid_id' => $pyramid_id], $request->all())) {
            if($this->resolvePyramid($pyramid,$config)) {
                return response()->json(['success' => 'Configuración guardada correctamente.']);
            } else {
                return response()->json(['error' => 'No se pudo resolver las interacciones.'],401);
            }
        } else {
            return response()->json(['error' => 'No pudo ser creada la configuración.'],401);
        }
    }

    protected function resolvePyramid(Pyramid $pyramid, PyramidConfiguration $config)
    {
        if ($this->resolvePyramidIntegrations($pyramid,$config)) {
            if ($this->resolveZonesIntegrations($pyramid,$config)) {
                if ($this->resolveLevelsIntegrations($pyramid,$config)) {
                    return true;
                }
            }
        }
        return false;
    }
}
