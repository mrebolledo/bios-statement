@extends('app.CRUD.modal')
@section('crud-content')
    <div class="form-group">
        <label class="form-label">Identificador</label>
        <input type="text" class="form-control" name="identifier" @if($is_edit) value="{{ $record->identifier }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Nombre</label>
        <input type="text" class="form-control" name="first_name" @if($is_edit) value="{{ $record->first_name }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Apellido</label>
        <input type="text" class="form-control" name="last_name" @if($is_edit) value="{{ $record->last_name }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Tipo de colaborador</label>
        <select class="form-control" name="type_id" id="type_id">
            @if(!$is_edit)
                <option value="" selected="" disabled>Seleccione...</option>
            @endif
            @foreach($types as $type)
                @if($is_edit)
                    @if($record->type_id == $type->id)
                        <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                    @else
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endif
                @else
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
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
    <div class="form-group">
        <label class="form-label">Teléfono</label>
        <input type="text" class="form-control" name="phone" @if($is_edit) value="{{ $record->phone }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Email</label>
        <input type="text" class="form-control" name="email" @if($is_edit) value="{{ $record->email }}" @endif>
    </div>
    <script>
       $(document).ready(function(){
            $('.selectpicker').selectpicker();
        });
    </script>
@endsection
