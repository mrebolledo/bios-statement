@extends('app.CRUD.modal')
@section('crud-content')
    <x-input label="Nombre" name="name" :isEdit="$is_edit" :value="$record->name ?? null"></x-input>
@endsection
