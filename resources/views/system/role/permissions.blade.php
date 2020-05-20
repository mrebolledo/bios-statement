@extends('app.components.modals.modal')
@section('modal-title','Permisos del Role: '.$role->name)
@section('modal-content')
    {!! getTableScript('permissionsTable') !!}
    <form class="my-5" role="form"  id="role-permissions-form">
        @csrf
        <div class="">
            <table class="table table-bordered table-striped" id="permissionsTable">
                <thead>
                    <tr>
                        <th>Entidad</th>
                        <th>Permisos</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($permissions as $key => $permission)
                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input main-control" name="{{ $key }}" id="{{ $key }}" value="{{ $key }}">
                                <label class="custom-control-label" for="{{ $key }}">{{ $key }}</label>
                            </div>
                        <td>
                            @foreach($permission as $p)
                                <div class="row">
                                    <div class="col-12">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="{{ $key }} custom-control-input" name="permissions[]" id="{{ $p->name }}" value="{{ $p->id }}" @if($role->hasPermissionTo($p->name)) checked @endif>
                                            <label class="custom-control-label" for="{{ $p->name }}">{{ explode('.',$p->name)[1] }}</label>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </form>
    <script>
        $('.main-control').change(function() {
            var id = this.id;
            if($(this).is(":checked")) {

                $('.'+id).prop('checked',true);
            }else {
                $('.'+id).prop('checked',false);
            }
            //'unchecked' event code
        });
    </script>

@endsection
@section('modal-validation')
    {!!  makeValidation('role-permissions-form',"/role/{$role->id}/permissions", "tableReload(); closeModal();") !!}
@endsection
@section('modal-width','60')
