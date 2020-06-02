@extends('app.CRUD.modal')
@section('crud-content')
    <x-input label="Nombre" name="name" :isEdit="$is_edit" :value="$record->name ?? null"></x-input>

    <x-input label="Icono" name="icon" :isEdit="$is_edit" :value="$record->icon ?? null"></x-input>

    <x-input label="Route" name="route" :isEdit="$is_edit" :value="$record->route ?? null"></x-input>

    <x-input label="Permiso" name="permission" :isEdit="$is_edit" :value="$record->permission ?? null"></x-input>
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
