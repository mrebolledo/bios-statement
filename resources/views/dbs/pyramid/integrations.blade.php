@extends('app.layouts.layout')
@section('title','Integración Pirámide')
@section('icon','fa-cogs')
@section('page-buttons')
    {!! makeBackButton() !!}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <h6 class="card-header">
                    {{ $pyramid->name }}
                </h6>
                <div class="card-body p-0">
                    <form id="integrations-form">
                    <div class="row">
                        <div class="col-xl-3 border-right p-5">
                            <dl>
                                <dt>Moverse hacia otra pirámide</dt>
                                <dd>{{ $pyramid->configuration->another_pyramid }} Noches de vacío</dd>
                                <dt>Moverse hacia otra zona</dt>
                                <dd>{{ $pyramid->configuration->another_zone }} Noches de vacío</dd>
                                <dt>Moverse hacia arriba</dt>
                                <dd>{{ $pyramid->configuration->level_up }} Noches de vacío</dd>
                                <dt>Moverse hacia abajo</dt>
                                <dd>{{ $pyramid->configuration->level_down }} Noches de vacío</dd>
                            </dl>
                        </div>
                        <div class="col-xl-4 p-5">
                                <h5 class="border-bottom">Pirámides</h5>
                                <div class="row">
                                    @foreach($pyramid->integrations as $integration)
                                        <div class="col-6 my-3">
                                            <div class="form-group">
                                                <label class="form_label">Pirámide: {{ $integration->destination->name }}</label>
                                                <input type="text" class="form-control" id="pyramid_{{$integration->destination->id}}" onblur="updatePyramidIntegration({{$pyramid->id}},{{$integration->destination->id}})" value="{{ $integration->empty_nights }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <h5 class="border-bottom">Zonas</h5>

                                @foreach($pyramid->levels->map(function($level) {
                                        return $level->sectors->map(function($sector){
                                            return $sector->zone;
                                        });
                                })->collapse()->unique('id') as $zone)
                                        <h6 class="mt-2 py-2 border-bottom">{{ $zone->name }}</h6>
                                            @foreach($zone->integrations as $integration)
                                                <div class="row">
                                                    <div class="col-9">
                                                        <label class="form_label">{{ $integration->destination->name }}</label>
                                                    </div>
                                                       <div class="col-3">
                                                           <input type="text" class="form-control" value="{{ $integration->empty_nights }}" id="zone_{{$zone->id}}_{{$integration->destination->id}}" onblur="updateZoneIntegration({{$zone->id}},{{$integration->destination->id}},{{$pyramid->id}})">
                                                       </div>
                                                </div>
                                            @endforeach
                                @endforeach

                        </div>
                        <div class="col-xl-5 p-5">
                            <h5 class="border-bottom">Niveles</h5>

                            @foreach($pyramid->levels->sortBy('position') as $level)
                                <h6 class="mt-2 py-2 border-bottom">{{ $level->name }}</h6>
                                    @foreach($level->integrations as $integration)
                                        <div class="row">
                                            <div class="col-9">
                                                <label class="form_label">{{ $integration->destination->name }} @if($level->position > $integration->destination->position) <i class="fas fa-arrow-up"></i> @else <i class="fas fa-arrow-down"></i>@endif</label>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control" value="{{ $integration->empty_nights }}" id="level_{{$level->id}}_{{$integration->destination->id}}" onblur="updateLevelIntegration({{$level->id}},{{$integration->destination->id}})">
                                            </div>
                                        </div>
                                    @endforeach
                            @endforeach
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function updatePyramidIntegration(pyramid,destination)
        {
            $.ajax({
                method : 'GET',
                url : '/integrations/pyramid-to-pyramid',
                data : {
                    pyramid_id : pyramid ,
                    destination_id : destination,
                    empty_nights : $('#pyramid_'+destination).val()
                },
                success : function(data) {
                    toastr.success('Integracion de pirámide modificada correctamente.');
                }
            });
        }

        function updateZoneIntegration(zone,destination,pyramid)
        {
            $.ajax({
                method : 'GET',
                url : '/integrations/zone-to-zone',
                data : {
                    pyramid_id : pyramid ,
                    destination_id : destination,
                    zone_id : zone,
                    empty_nights : $('#zone_'+zone+'_'+destination).val()
                },
                success : function(data) {
                    toastr.success('Integracion de Zona modificada correctamente.');
                }
            });
        }

        function updateLevelIntegration(level,destination)
        {
            $.ajax({
                method : 'GET',
                url : '/integrations/level-to-level',
                data : {
                    destination_id : destination,
                    level_id : level,
                    empty_nights : $('#level_'+level+'_'+destination).val()
                },
                success : function(data) {
                    toastr.success('Integracion de Nivel modificada correctamente.');
                }
            });
        }
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
@endsection
@section('scripts')

    <script src="{{ mix('/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
@endsection
