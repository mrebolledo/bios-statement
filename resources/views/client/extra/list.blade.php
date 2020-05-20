@extends('app.components.modals.modal')
@section('modal-title','Declaraciones de Usuario')
@section('modal-content')
    <div class="row">
        <div class="col-xl-12 table-responsive">
            <table class="table table-striped">
                <tr>
                    <th>rut</th>
                    <td>{{  $collaborator->identifier }}</td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td>{{  $collaborator->firt_name.' '.$collaborator->last_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{  $collaborator->email }}</td>
                </tr>
                <tr>
                    <th>Telefono</th>
                    <td>{{  $collaborator->phone }}</td>
                </tr>
                <tr>
                    <th>Empresa</th>
                    <td>{{  $collaborator->enterprise->rut }} {{ $collaborator->enterprise->name }}</td>
                </tr>
                <tr>
                    <th>Email Empresa</th>
                    <td>{{  $collaborator->enterprise->email }}</td>
                </tr>
                <tr>
                    <th>Teléfono Empresa</th>
                    <td>{{  $collaborator->enterprise->phone }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>fecha</th>
                        <th>Sentencia 1</th>
                        <th>Sentencia 2</th>
                        <th>Sentencia 3</th>
                        <th>Sentencia 4</th>
                        <th>Puede Entrar</th>
                        <th>Motivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collaborator->statements->sortByDesc('id') as $statement)
                        <tr>
                            <td>{{ $statement->id }}</td>
                            <td>{{ $statement->statement_date }}</td>
                            <td>{{ ($statement->statement_1 === 1)?'SI':'NO' }}</td>
                            <td>{{ ($statement->statement_2 === 1)?'SI':'NO' }}</td>
                            <td>{{ ($statement->statement_3 === 1)?'SI':'NO' }}</td>
                            <td>{{ ($statement->statement_4 === 0)?'SI':'NO' }}</td>
                            <td>{{ ($statement->can_enter === 1)?'SI':'NO' }}</td>
                            <td>{{ $statement->reason ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('no-submit')
    .
@endsection
