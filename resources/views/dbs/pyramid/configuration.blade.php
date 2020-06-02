@extends('app.components.modals.modal')
@section('modal-icon','fa-cog')
@section('modal-title','Configuracion Pirámide: '.$pyramid->name)
@section('modal-content')
 <div class="alert alert-info">
     <strong>IMPORTANTE</strong> <br>
     Al modificar esta configuración, estará modificando todas las interacciones de esta pirámide de forma masiva, si lo que desea es solo afectar un grupo pequeño de sectores, utilice el panel de interacciones de la pirámide.
 </div>
 <div class="row">
     <div class="col">
         <form id="configuration-form">
             @csrf
            <p>Indique la cantidad de noches de vacío.</p>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">Se mueve a otra píramide</label>
                        <input type="text" class="form-control" name="another_pyramid" value="{{ optional($pyramid->configuration)->another_pyramid }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">Se mueve a otra zona</label>
                        <input type="text" class="form-control" name="another_zone" value="{{ optional($pyramid->configuration)->another_zone }}">
                    </div>
                </div>
            </div>
             <div class="row">
                 <div class="col-6">
                     <div class="form-group">
                         <label class="form-label">Se mueve hacia arriba</label>
                         <input type="text" class="form-control" name="level_up" value="{{ optional($pyramid->configuration)->level_up }}">
                     </div>
                 </div>
                 <div class="col-6">
                     <div class="form-group">
                         <label class="form-label">Se mueve hacia abajo</label>
                         <input type="text" class="form-control" name="level_down" value="{{ optional($pyramid->configuration)->level_down }}">
                     </div>
                 </div>
             </div>
         </form>
     </div>
 </div>
@endsection
@section('modal-validation')
    {!! makeValidation('configuration-form',route('pyramids.configuration-store',['pyramid_id' => $pyramid->id]),'closeModal();') !!}
@endsection
