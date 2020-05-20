@extends('app.CRUD.modal')
@section('crud-content')
    <input type="hidden" name="level_id" value="{{ $level_id }}">
    <div class="form-group">
        <label class="form-label">Nombre</label>
        <input type="text" class="form-control" name="name" @if($is_edit) value="{{ $record->name }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Zona</label>
        <select class="form-control" name="zone_id" id="zone_id">
            @if(!$is_edit)
                <option value="" selected="" disabled>Seleccione...</option>
            @endif
            @foreach($zones as $zone)
                @if($is_edit)
                    @if($record->zone_id == $zone->id)
                        <option value="{{ $zone->id }}" selected>{{ $zone->name }}</option>
                    @else
                        <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                    @endif
                @else
                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
@endsection
