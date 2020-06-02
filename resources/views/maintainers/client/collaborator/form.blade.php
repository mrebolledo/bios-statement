@extends('app.CRUD.modal')
@section('crud-content')
    <x-input label="Identificador" name="identifier" :isEdit="$is_edit" :value="$record->identifier ?? null"></x-input>
    <x-input label="Nombre" name="first_name" :isEdit="$is_edit" :value="$record->first_name ?? null"></x-input>
    <x-input label="Apellido" name="last_name" :isEdit="$is_edit" :value="$record->last_name ?? null"></x-input>
    <x-combo
        label="Tipo de Colaborador"
        name="type_id"
        :comparator="$record->type_id ?? null"
        :isEdit="$is_edit"
        display="name"
        entity="collaborator-types"></x-combo>


    <div class="form-group">
        <label class="from-label" >Empresa</label>
        <select class="selectpicker" data-style="btn-default" data-live-search="true" name="enterprise_id">
            @if(!$is_edit)
                <option value="" selected="" disabled>Seleccione...</option>
            @endif
            @foreach($enterprises as $enterprise)
                @if($is_edit)
                    @if($record->enterprise_id == $enterprise->id)
                        <option data-tokens="{{ $enterprise->rut }} | {{ $enterprise->name }}" value="{{ $enterprise->id }}" selected>{{ $enterprise->rut }} | {{ $enterprise->name }}</option>
                    @else
                        <option data-tokens="{{ $enterprise->rut }} | {{ $enterprise->name }}" value="{{ $enterprise->id }}">{{ $enterprise->rut }} | {{ $enterprise->name }}</option>
                    @endif
                @else
                    <option data-tokens="{{ $enterprise->rut }} | {{ $enterprise->name }}" value="{{ $enterprise->id }}">{{ $enterprise->rut }} | {{ $enterprise->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <x-input label="Teléfono" name="phone" :isEdit="$is_edit" :value="$record->phone ?? null"></x-input>

    <x-input label="Email" name="email" :isEdit="$is_edit" :value="$record->email ?? null"></x-input>

    <script>
       $(document).ready(function(){
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection
