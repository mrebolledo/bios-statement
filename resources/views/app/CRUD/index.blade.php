@extends('app.layouts.layout')
@section('title',$title)
@section('icon',$icon)
@section('page-buttons')
    @can($entity.'.create')
        @if(request()->has('filter'))
            {!! makeRemoteLink(route($entity.'.create',['filter' => request()->filter]),'Agregar Nuevo','fa-plus','btn-primary','btn-sm') !!}
            {!! makeLink($back,'Volver', 'fa-arrow-left','btn-info','btn-sm') !!}
        @else
            {!! makeRemoteLink(route($entity.'.create'),'Agregar Nuevo','fa-plus','btn-primary','btn-sm') !!}
        @endif
    @endif
    @if(count($extra_buttons) > 0)
        @foreach($extra_buttons as $extra_button)
            {!! $extra_button !!}
        @endforeach
    @endif
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <h6 class="card-header">
                    Listado de Registros
                </h6>
                <div class="card-datatable table-responsive">
                    {!! makeTable($columns) !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
@endsection
@section('scripts')
    <script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>
    <script src="{{ mix('/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    {!! getAjaxTable(request()->has('filter')? $entity.'/?filter='.request()->filter: $entity) !!}
@endsection
