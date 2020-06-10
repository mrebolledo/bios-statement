@extends('emails.base')
@section('mail-content')
    @php
        $ls = $collaborator->statements()->orderBy('id','desc')->first();
    @endphp
    <div style="text-align: center; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 1.2em; padding-left: 50px; padding-right: 50px; margin-bottom: 50px;">
        <h4>Sr/a {{ $collaborator->first_name }} {{ $collaborator->last_name }}, RUT: {{ $collaborator->identifier }}</h4>
        Hoy <b>{{ \Carbon\Carbon::parse($ls->statement_date)->toDateString() }}</b>, hemos registrado su declaración jurada COVID-19 en donde declara bajo juramento lo siguiente:
        <br>
        <br>
           <b>{{ ($ls->statement_1 === 1)?'SI':'NO' }}</b> haber visitado o trabajado en el extranjero en los últimos 14 días.
        <br><br>
            <b>{{ ($ls->statement_2 === 1)?'SI':'NO' }}</b> haber estado en contacto cercano con algún caso confirmado de COVID-19 dentro de los últimos 14 días.
        <br><br>
           <b>{{ ($ls->statement_3 === 1)?'SI':'NO' }}</b> haber acudido a algún centro de salud, en los últimos 14 días, por alguno de los siguientes síntomas: dificultad para tragar, dolor de cabeza, dolor muscular, tos, fiebre sobre 37,8°C y/o dificultad respiratoria.
        <br><br>
        <b>{{ ($ls->statement_4 === 0)?'SI':'NO' }}</b> informaré inmediatamente a mi supervisor o jefe de Instalación en caso de presentar uno o más de los síntomas anteriormente descritos.

        <br><br>
        @if($ls->can_enter === 0)
            Por motivos de seguridad usted no esta autorizado para ingresar a los sectores productivos de Agricola Super Ltda, por favor contacte a su Jefe directo para resolver la situación.
        @else
            Usted se encuentra autorizado a ingresar a los sectores productivos de Agricola Super Ltda, conservando las autorizaciones y respetando todas las normas de bioseguridad vigentes. Esta declaración tiene una vigencia de 14 días consecutivos, una vez terminado este plazo, para poder reingresar a granjas, completar nuevamente la declaración.
        @endif
        <br><br>
        <h4><small>Código Verificación :</small> {{ $collaborator->statements()->orderBy('id','desc')->first()->verification_code }}</h4>
        <br>
        Saludos cordiales, DBS - CMATIK
    </div>

@endsection
