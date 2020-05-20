@extends('app.layouts.layout-blank')

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
@endsection
@section('scripts')
    <script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>
    {!! getAjaxTable((isset($filter) && $filter != '')?$entity.'/?filter='.$filter: $entity) !!}
@endsection
