@extends('app.components.modals.modal')
@php
    if(request()->has('filter')) {
        $filter = ['filter' => request()->filter];
    } else {
        $filter = [];
    }
    if  ($is_edit) {
        $var = \Illuminate\Support\Str::slug(\Illuminate\Support\Str::singular($entity),'_');
        $url = route($entity.'.update',array_merge([$var => $record->id], $filter));
    } else {
        $url = route($entity.'.store', $filter);
    }
@endphp

@section('modal-title',$title)
@section('modal-icon',$icon)
@section('modal-content')
    <form id="{{ $entity }}-form">
        @csrf
        @if($is_edit)
            @method('put')
        @endif
        @yield('crud-content')
    </form>
@endsection
@section('modal-validation')
    {!! makeValidation($entity.'-form',$url,'tableReload(); closeModal();') !!}
@endsection
