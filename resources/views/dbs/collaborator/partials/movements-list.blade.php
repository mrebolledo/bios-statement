<div class="card ">
    <div class="card-header with-elements">
                    <span class="card-header-title mr-2">
                        <i class="fas fa-table"> Listado de Movimientos</i>
                    </span>
        <div class="card-header-elements ml-md-auto">
            @can('collaborator-movements.simulate-view')
                {!! makeRemoteLink(route('collaborator-movements.simulate-view',['collaborator_id' => $collaborator->id]),'Simular Movimiento','fa-door-open','btn-primary','btn-xs') !!}
                {!! makeRemoteLink(route('collaborator-movements.simulate-view'),'Simular Movimiento (sin colaborador)','fa-door-open','btn-warning','btn-xs') !!}

            @endif
        </div>
    </div>
    <div class="card-datatable table-responsive">
        {!! makeTable($columns,false,'collaborator-movements-table') !!}
    </div>
</div>
