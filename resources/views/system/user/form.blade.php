@extends('app.CRUD.modal')
@section('crud-content')
    <div class="form-group">
        <label class="form-label">Nombre</label>
        <input type="text" class="form-control" name="first_name" @if($is_edit) value="{{ $record->first_name }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Apellido</label>
        <input type="text" class="form-control" name="last_name" @if($is_edit) value="{{ $record->last_name }}" @endif>
    </div>
    <div class="form-group">
        <label class="form-label">Email</label>
        <input type="text" class="form-control" name="email" @if($is_edit) value="{{ $record->email }}" @endif>
    </div>
    <div id="roles">
        <h5>Roles</h5>
        @foreach($roles as $r)
            @if(isset($record))
                @if($record->hasRole($r->id))
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox"  class="custom-control-input" value="{{ $r->id }}" checked name="roles[]">
                        <span class="custom-control-label">{{ $r->name }}</span>
                    </label>
                @else
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox"  class="custom-control-input" value="{{ $r->id }}"  name="roles[]">
                        <span class="custom-control-label">{{ $r->name }}</span>
                    </label>
                @endif
            @else
                <label class="custom-control custom-checkbox">
                    <input type="checkbox"  class="custom-control-input" value="{{ $r->id }}" name="roles[]">
                    <span class="custom-control-label">{{ $r->name }}</span>
                </label>
            @endif

        @endforeach
    </div>
@endsection
