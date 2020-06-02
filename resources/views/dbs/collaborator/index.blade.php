@extends('app.layouts.layout')
@section('title','Administrar: '.$collaborator->full_name )
@section('icon','fa-cog')
@section('page-buttons')
    {!! makeBackButton() !!}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3 mb-2">
            @include('dbs.collaborator.partials.collaborator-card',['collaborator' => $collaborator])
        </div>
        <div class="col-xl-9 mb-2">
            @can('collaborator-movements.list')
                @include('dbs.collaborator.partials.movements-list',[
                    'collaborator' => $collaborator,
                    'columns' => $columns
                ])
            @endif
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
    @can('collaborator-movements.list')
        {!! getAjaxTable('collaborator-movements/?filter='.$collaborator->id,'collaborator-movements-table') !!}
    @endif
    <script>
        $(document).ready(function(){
            $('#datepicker-input').datepicker();
        });
    </script>
@endsection

