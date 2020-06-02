@extends('app.components.modals.modal')
@section('modal-title', 'Simular Movimiento')
@section('modal-icon','fa-door-open')
@section('modal-content')
    <form id="simulate-movement-form">
        @csrf
        @if(isset($collaborators) && count($collaborators) > 0)
           <div class="form-group">
               <label class="form-label">Colaborador</label>
               <select class="selectpicker form-control" data-style="btn-default" data-live-search="true" name="collaborators">
                   <option value="" selected="" disabled>Seleccione...</option>
                   @foreach($collaborators as $c)
                       <option data-tokens="{{ $c->identifier }} {{ $c->full_name }}" value="{{ $c->id }}">{{ $c->identifier }} {{ $c->full_name }}</option>
                   @endforeach
               </select>
           </div>
            <input type="hidden" name="collaborator_id" id="collaborator_id">
        @else
            <div class="alert alert-info">
                Colaborador: {{ $collaborator->full_name }}
            </div>
            <x-hidden name="collaborator_id" :value="$collaborator->id"></x-hidden>

        @endif

        <x-combo
            label="Pirámide"
            name="pyramid_id"
            display="name"
            entity="pyramids"></x-combo>

        <div id="levels">
            <div class="form-group">
                <label class="form-label">Niveles</label>
                <select class="form-control" name="level_id">
                    <option value="" selected="" disabled>Seleccione Pirámide...</option>
                </select>
            </div>
        </div>

        <div id="sectors">
            <div class="form-group">
                <label class="form-label">Sectores</label>
                <select class="form-control" name="sector_id">
                    <option value="" selected="" disabled>Seleccione Nivel...</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Fecha de Ingreso</label>
            <input type="text" class="form-control" id="datepicker-input" name="check_in_date">
        </div>
        @can('collaborator-movements.insert-simulation')
            <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="insert-simulation" name="insert_simulation"  value="1" >
                <label class="custom-control-label" for="insert-simulation">Insertar Simulación</label>
            </label>
        @endif
    </form>
    <script>
        $(document).ready(function(){
            $('.selectpicker').selectpicker();
        });

        $('select[name="collaborators"]').on('change', function(){
            $('#collaborator_id').val($(this).val());
        });

        $('select[name="pyramid_id"]').on('change',function(){
            $.get('/getCombo',{
                filter: $(this).val(),
                filterField: 'pyramid_id',
                entity: 'pyramid-levels',
                label : 'Niveles',
                name : 'level_id',
                functionNext: ' $(\'select[name="level_id"]\').on(\'change\',function(){\n' +
                    '            $.get(\'/getCombo\',{\n' +
                    '                filter: $(this).val(),\n' +
                    '                filterField: \'level_id\',\n' +
                    '                entity: \'sectors\',\n' +
                    '                label : \'Sectores\',\n' +
                    '                name : \'sector_id\',\n' +
                    '\n' +
                    '            },function(data){\n' +
                    '                $(\'#sectors\').html(data);\n' +
                    '            });\n' +
                    '        });'
            },function(data){
                $('#levels').html(data);
            });
        });


    </script>
@endsection
@section('modal-validation')
    {!! makeValidation('simulate-movement-form',route('collaborator-movements.simulate-store',['collaborator_id' => $collaborator->id ?? null]),' ') !!}
@endsection
