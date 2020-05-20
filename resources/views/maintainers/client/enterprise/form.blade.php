@extends('app.CRUD.modal')
@section('crud-content')
    <div class="form-group">
        <label class="form-label">Rut</label>
        <input type="text" class="form-control" name="rut" @if($is_edit) value="{{ $record->rut }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Nombre</label>
        <input type="text" class="form-control" name="name" @if($is_edit) value="{{ $record->name }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Teléfono</label>
        <input type="text" class="form-control" name="phone" @if($is_edit) value="{{ $record->phone }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Email</label>
        <input type="text" class="form-control" name="email" @if($is_edit) value="{{ $record->email }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Representate</label>
        <input type="text" class="form-control" name="representative" @if($is_edit) value="{{ $record->representative }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Nombre coordinador empresa mandante</label>
        <input type="text" class="form-control" name="principal_name" @if($is_edit) value="{{ $record->principal_name }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Email coordinador empresa mandante</label>
        <input type="text" class="form-control" name="principal_email" @if($is_edit) value="{{ $record->principal_email }}" @endif>
    </div>
@endsection
