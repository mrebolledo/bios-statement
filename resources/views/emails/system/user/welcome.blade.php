@extends('emails.base')
@section('mail-content')
    <h4>Sr/a {{ $collaborator->first_name }} {{ $collaborator->last_name }}</h4>
    <p style="font-size: 12px;">
        CMATIK ha creado una cuenta para ti en nuestro sistema DBS <br>
        Debes hacer click en "Crear mi contraseña" para activar tu cuenta y tu usuario es tu dirección de E-mail
        <br>
        Una vez creada tu contraseña recuerda utilizar y guardar en tus favoritos la siguiente URL: <br>
        <a href="https://erm.cmatik.app" style="font-size: 14px">https://erm.cmatik.app</a>
    </p>
    <table bgcolor="#0073AA" border="0" cellspacing="0" cellpadding="0" class="buttonwrapper">
        <tr>
            <td align="center" height="50" style=" padding: 0 25px 0 25px; font-family: Arial, sans-serif; font-size: 16px; font-weight: bold;" class="button">
                <a href="{{ env('APP_URL') }}/reset/{{ $user->email }}/{{ $code }}" style="color: #ffffff; text-align: center; text-decoration: none;">Crear mi contraseña</a>
            </td>
        </tr>
    </table>
    Saludos cordiales, DBS - CMATIK
@endsection
