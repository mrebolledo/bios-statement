@extends('app.layouts.layout')
@section('title','Permisos del colaborador '.$collaborator->full_name )
@section('icon','fa-key')
@section('page-buttons')
    {!! makeBackButton() !!}
    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#collaborator-sectors-forms').submit();"><i class="fas fa-save"></i> Guardar</a>
@endsection
@section('content')
    <form id="collaborator-sectors-forms">
        <h5>Fechas de inicio y termino de acceso para el colaborador (obligatorias)</h5>
        <div class="input-daterange input-group mb-3" id="datepicker-range">
            <div class="input-group-prepend">
                <span class="input-group-text">Desde</span>
            </div>
            <input type="text" class="form-control datepicker" name="access_start" value="{{ $collaborator->access_start }}">
            <div class="input-group-prepend">
                <span class="input-group-text">Hasta</span>
            </div>
            <input type="text" class="form-control datepicker" name="access_expires" value="{{ $collaborator->access_expires }}">
        </div>
        @csrf
        <div class="nav-tabs-top nav-responsive-xl">
            <ul class="nav nav-tabs">
                @foreach($pyramids as $pyramid)
                <li class="nav-item">
                    <a class="nav-link @if($loop->first) active @endif" data-toggle="tab" href="#pyramid_{{ $pyramid->id }}">{{ $pyramid->name }}</a>
                </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach($pyramids as $pyramid)
                    <div class="tab-pane fade show  @if($loop->first) active @endif" id="pyramid_{{ $pyramid->id }}">
                        <div class="card-body">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input pyramid-check" name="pyramids[]" value="{{ $pyramid->id }}">
                                <span class="custom-control-label">Check/Uncheck todos en la Pirámide</span>
                            </label>
                            @foreach($pyramid->levels->sortBy('position') as $level)
                                <div class="w-100 p-3 rounded mb-2" style="background-color: #eaf3fc">
                                    <div>
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input level-check" value="{{ $level->id }}" name="levels[]">
                                            <span class="custom-control-label">{{ $level->name }}</span>
                                        </label>
                                    </div>
                                    @foreach($level->sectors->groupBy('zone.full_name')->chunk(3) as $chunk)
                                        <div class="row px-3">
                                            @foreach($chunk as $zone => $sectors)
                                                <div class="col-xl-4 py-2 rounded " >
                                                    <div style="background-color: #d9e2eb" class="rounded py-2">
                                                        <div class="border-bottom p-2 mb-2">
                                                            <label class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input zone-check" value="{{ \Illuminate\Support\Str::slug($zone) }}" name="zones[]">
                                                                <span class="custom-control-label">{{ $zone }}</span>
                                                            </label>
                                                        </div>
                                                        <div class="w-100 rounded px-4" >
                                                            @foreach($sectors as $sector)
                                                                <label class="custom-control custom-checkbox">
                                                                    <input type="checkbox" @if($access = $collaborator->accesses->whereIn('id',$sector->id)->first()) @if($access->allowed === 1) checked @endif @endif class="custom-control-input pyramid_{{ $pyramid->id }} level_{{ $level->id }} zone_{{ \Illuminate\Support\Str::slug($zone) }}" name="sectors[]" value="{{ $sector->id }}">
                                                                    <span class="custom-control-label">{{ $sector->name }} <small class="text-muted">@if($access) {{ $access->updated_at }} @endif</small></span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </form>
    <script>
        $('.pyramid-check').change(function() {
            var id = $(this).val();
            if($(this).is(":checked")) {
                $('.pyramid_'+id).prop('checked',true);
            }else {
                $('.pyramid_'+id).prop('checked',false);
            }
        });

        $('.level-check').change(function() {
            var id = $(this).val();
            if($(this).is(":checked")) {
                $('.level_'+id).prop('checked',true);
            }else {
                $('.level_'+id).prop('checked',false);
            }
        });

        $('.zone-check').change(function() {
            var id = $(this).val();
            if($(this).is(":checked")) {
                $('.zone_'+id).prop('checked',true);
            }else {
                $('.zone_'+id).prop('checked',false);
            }
        });
    </script>
    {!! makeValidation('collaborator-sectors-forms',route('collaborator.sectors-store',['collaborator' => $collaborator->id]),'location.reload();') !!}
@endsection
@section('scripts')
    <script>
        $('#datepicker-range').datepicker({
            showOn: "both",
            format: "yyyy-mm-dd",
            changeYear : true,
            changeMonth : true
        });
    </script>
@endsection
