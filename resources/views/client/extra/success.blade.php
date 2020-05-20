@extends('app.layouts.layout-blank')

@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto mt-xl-3 mb-xl-5">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-sm-5">
                        <div class="col-6">
                            <img src="{{ asset('images/logo.png') }}" alt="Cmatik" class="w-50  mx-auto mt-5">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('images/logo-cliente2.jpg') }}" alt="Agrosuper" class="pull-right" style="width: 50%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-offset-2 mx-auto">
                            <h1 class="text-center">DECLARACIÓN JURADA COVID-19</h1>
                            <br><br>

                            <p class="text-justify">
                                <span class="alert alert-success">
                                  Código   <strong>"{{ $statement->verification_code }}" </strong> verificado correctamente.
                                </span>
                            </p> <br><br>
                            <p class="text-justify">
                                Bajo la actual situación que vive nuestro país  y con el objetivo de proteger la salud de nuestros colaboradores y reducir los contagios, hemos implementado un protocolo de ingreso a todas las instalaciones productivas de Agricola Super Ltda.
                            </p>
                            <p class="text-justify">
                                Este protocolo requiere que complete la siguiente declaración jurada, si usted cumple con los ítems mencionados podrá ingresar nuevamente manteniendo las autorizaciones vigentes y por supuesto respetando todas nuestras normas de bioseguridad, de lo contrario rogamos comunicarse con el departamento de sanidad y no intentar ingresar a nuestras instalaciones.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 mx-auto">
                            <form class="mb-xl-5 mt-5" id="statement-form">
                                @csrf
                                <div class="form-group">
                                    <label for="rut">RUT</label>
                                    <input type="text" id="rut" name="rut" class="form-control"  readonly value="{{ $statement->collaborator->identifier }}">
                                </div>
                                <div class="form-group">
                                    <label for="rut">Nombre</label>
                                    <input type="text" id="name" name="name" class="form-control"  readonly value="{{ $statement->collaborator->first_name }} {{ $statement->collaborator->last_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="rut">Empresa</label>
                                    <input type="text" id="enterprise" name="enterprise" class="form-control"  readonly value="{{ $statement->collaborator->enterprise->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="rut">Email</label>
                                    <input type="text" id="email" name="email" class="form-control"  readonly value="{{ $statement->collaborator->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="rut">Teléfono</label>
                                    <input type="text" id="phone" name="phone" class="form-control"  readonly value="{{ $statement->collaborator->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="rut">Fecha de la declaración</label>
                                    <input type="text" id="date" name="date" class="form-control"  readonly value="{{ $statement->statement_date }}">
                                </div>
                                <p class="font-weight-bolder my-5 border-bottom">Declaro:</p>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="statement_1" value="1" disabled @if($statement->statement_1 === 1) checked @endif>
                                    <span class="custom-control-label text-justify"><strong>{{ ($statement->statement_1 === 1)?'SI':'NO' }}</strong> haber visitado o trabajado en el extranjero en los últimos 14 días.</span>
                                </label>
                                <label class="custom-control custom-checkbox mt-3">
                                    <input type="checkbox" class="custom-control-input" name="statement_2" value="1" disabled @if($statement->statement_2 === 1) checked @endif>
                                    <span class="custom-control-label text-justify"><strong>{{ ($statement->statement_2 === 1)?'SI':'NO' }}</strong> haber estado en contacto cercano con algún caso confirmado de Coronavirus dentro de los últimos 14 días.</span>
                                </label>
                                <label class="custom-control custom-checkbox mt-3">
                                    <input type="checkbox" class="custom-control-input" name="statement_3" value="1" disabled @if($statement->statement_3 === 1) checked @endif>
                                    <span class="custom-control-label text-justify"><strong>{{ ($statement->statement_3 === 1)?'SI':'NO' }}</strong> haber acudido a algún centro de salud, en los últimos 14 días, por alguno de los siguientes síntomas: dificultad para tragar, dolor de cabeza, dolor muscular, tos, fiebre sobre 37,8°C y/o dificultad respiratoria.</span>
                                </label>
                                <label class="custom-control custom-checkbox mt-3">
                                    <input type="checkbox" class="custom-control-input" name="statement_4" value="1" disabled @if($statement->statement_4 === 0) checked @endif>
                                    <span class="custom-control-label text-justify"><strong>{{ ($statement->statement_4 === 0)?'SI':'NO' }}</strong> Informaré inmediatamente a mi supervisor o jefe de Instalación en caso de presentar uno o más de los síntomas anteriormente descritos.</span>
                                </label>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
