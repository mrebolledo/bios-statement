<div class="modal-header">
    <h5 class="modal-title">
        @hasSection('modal-icon')
            <i class="fas @yield('modal-icon')"></i>
        @else
            <i class="fas  fa-database"></i>
        @endif
         @yield('modal-title')
    </h5>

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="fas fa-times"></i></span>
    </button>
</div>
<div class="modal-body">
    @yield('modal-content')
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    @hasSection('no-submit')
        @yield('no-submit')
    @else
        @if(isset($requires_confirmation) && $requires_confirmation)
            <button type="button" class="btn btn-primary" onClick="confirmFormAction();">Guardar</button>
        @else
            <button type="button" class="btn btn-primary" onClick="$('.modal-content form').submit();">Guardar</button>
        @endif
    @endif
</div>

@yield('modal-validation')
<script>
    @if(isset($requires_confirmation) && $requires_confirmation)
        function confirmFormAction()
        {
            Swal.fire({
                title: "Esta accion requiere confirmación",
                text:  'Presione "Si, Ejecutar" para realizar la acción' ,
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Ejecutar"
            }).then(function (result) {
                if (result.value) {
                    $('.modal-content form').submit();
                } else {
                    Swal.close();
                }
            });
        }
    @endif

    $('.fire-modal').on('click',function(e){
        e.preventDefault();
        loadModal($(this).attr('href'))
    });
</script>
