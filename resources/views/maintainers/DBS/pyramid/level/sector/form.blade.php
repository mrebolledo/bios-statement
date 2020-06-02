@extends('app.CRUD.modal')
@section('crud-content')
    <x-hidden :value="$hidden_id" name="level_id" ></x-hidden>

    <x-input label="Nombre" name="name" :isEdit="$is_edit" :value="$record->name ?? null"></x-input>

    <x-input label="Id Interno (grd_id)" name="grd_id" :isEdit="$is_edit" :value="$record->name ?? null"></x-input>

    <x-combo
        label="Zona"
        name="zone_id"
        :comparator="$record->zone_id ?? null"
        :isEdit="$is_edit ?? null"
        display="name"
        entity="zones"></x-combo>

@endsection
