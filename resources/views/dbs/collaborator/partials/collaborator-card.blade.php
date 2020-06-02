<div class="card">
    <div class="card-header">
        <i class="fas fa-user"></i> Información personal
    </div>
    <div class="card-body">
        <dl>
            <dt>Nombre</dt>
            <dd>{{ $collaborator->full_name }}</dd>
            <dt>Identificador</dt>
            <dd>{{ $collaborator->identifier }}</dd>
            <dt>Teléfono</dt>
            <dd>{{ $collaborator->phone }}</dd>
            <dt>Email</dt>
            <dd>{{ $collaborator->email }}</dd>
            <dt>Tipo</dt>
            <dd>{{ $collaborator->type->name }}</dd>
            <dt>Inicio Acceso</dt>
            <dd>{{ $collaborator->access_start }}</dd>
            <dt>Fin Acceso</dt>
            <dd>{{ $collaborator->access_expires }}</dd>
        </dl>
    </div>
</div>
