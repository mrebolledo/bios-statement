@extends('app.CRUD.modal')
@section('crud-content')
    <div class="form-group">
        <label class="form-label">Nombre</label>
        <input type="text" class="form-control" name="name" @if($is_edit) value="{{ $record->name }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Nombre Corto</label>
        <input type="text" class="form-control" name="short_name" @if($is_edit) value="{{ $record->short_name }}" @endif>
    </div>
@endsection
