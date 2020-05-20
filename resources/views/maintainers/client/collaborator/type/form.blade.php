@extends('app.CRUD.modal')
@section('crud-content')
    <div class="form-group">
        <label class="form-label">Nombre</label>
        <input type="text" class="form-control" name="name" @if($is_edit) value="{{ $record->name }}" @endif>
    </div>
@endsection
