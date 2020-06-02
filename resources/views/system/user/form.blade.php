@extends('app.CRUD.modal')
@section('crud-content')
    <x-input label="Nombre" name="first_name" :isEdit="$is_edit" :value="$record->first_name ?? null"></x-input>
    <x-input label="Apellido" name="last_name" :isEdit="$is_edit" :value="$record->last_name ?? null"></x-input>
    <x-input label="Email" name="emai" :isEdit="$is_edit" :value="$record->email ?? null"></x-input>
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
