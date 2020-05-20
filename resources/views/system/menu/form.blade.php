@extends('app.CRUD.modal')
@section('crud-content')
    <div class="form-group">
        <label class="form-label">Nombre</label>
        <input type="text" class="form-control" name="name" @if($is_edit) value="{{ $record->name }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Icono</label>
        <input type="text" class="form-control" name="icon" @if($is_edit) value="{{ $record->icon }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Route</label>
        <input type="text" class="form-control" name="route" @if($is_edit) value="{{ $record->route }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Permiso</label>
        <input type="text" class="form-control" name="permission" @if($is_edit) value="{{ $record->permission }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Item Padre</label>
        <select class="form-control" name="parent_id" id="parent_id">
            @if($is_edit)
                @if($record->parent_id == null)
                    <option value="" selected >Item Principal</option>
                @else
                    <option value="">Item Principal</option>
                @endif
            @else
                <option value="">Item Principal</option>
            @endif
            @foreach($menus as $m)
                @if($is_edit)
                    @if($record->parent_id == $m->id)
                        <option value="{{ $m->id }}" selected>{{ $m->name }}</option>
                    @else
                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                    @endif
                @else
                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                @endif
            @endforeach
        </select>
    </div>
@endsection
