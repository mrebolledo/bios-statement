@extends('app.layouts.layout-blank')

@section('content')
    <script>
        function findRut()
        {
            let rut = $('#rut').val();
            if(rut.trim() !== '') {

                $.ajax({
                    url     : '/findRut/'+rut,
                    type    : 'GET',
                    dataType: "json",
                    success : function(data){
                        $('#statement-form .alert').remove();
                        $('#name').val(data.worker_name);
                        $('#enterprise').val(data.enterprise);
                    },
                    error : function(response) {
                        $('#statement-form .alert').remove();
                        let messages = jQuery.parseJSON(response.responseText);

                        $('#statement-form').prepend("<div class='alert alert-danger alert-dismissible fade show'>"+messages.error+"<button type='button' class='close' data-dismiss='alert'>×</button></div>");
                    }
                });
            }
        }
    </script>
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
                                    <label for="rut">Ingrese su RUT</label>
                                    <input type="text" id="rut" name="rut" class="form-control" onBlur="findRut()">
                                </div>
                                <div class="form-group">
                                    <label for="rut">Nombre</label>
                                    <input type="text" id="name" name="name" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="rut">Empresa</label>
                                    <input type="text" id="enterprise" name="enterprise" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="rut">Email</label>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="rut">Ingrese su número de teléfono</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">+56</div>
                                        </div>
                                        <input type="text" id="phone" name="phone" class="form-control">
                                    </div>
                                </div>
                                <p class="font-weight-bolder mt-5  mb-3 border-bottom">Declaro:</p>

                                <div class="mb-3" id="statement_1">
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statement_1" id="statement_1" value="1">
                                        <span class="form-check-label">
                                              SI
                                        </span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statement_1" id="statement_1" value="0">
                                        <span class="form-check-label">
                                              NO
                                        </span>
                                    </label>
                                    <span class="text-justify">Haber visitado o trabajado en el extranjero en los últimos 14 días.</span>
                                </div>
                                <div class="mb-3" id="statement_2">
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statement_2" value="1">
                                        <span class="form-check-label">
                                              SI
                                            </span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statement_2" value="0">
                                        <span class="form-check-label">
                                              NO
                                            </span>
                                    </label>
                                    <span class=" text-justify">Haber estado en contacto cercano con algún caso confirmado de Coronavirus dentro de los últimos 14 días.</span>

                                </div>
                                    <div class="mb-3" id="statement_3">
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="statement_3" value="1">
                                            <span class="form-check-label">
                                              SI
                                            </span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="statement_3" value="0">
                                            <span class="form-check-label">
                                              NO
                                            </span>
                                        </label>
                                        <span class="text-justify">Haber acudido a algún centro de salud, en los últimos 14 días, por alguno de los siguientes síntomas: dificultad para tragar, dolor de cabeza, dolor muscular, tos, fiebre sobre 37,8°C y/o dificultad respiratoria.</span>

                                    </div>
                                <div id="statement_4">
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statement_4" value="0">
                                        <span class="form-check-label">
                                              SI
                                            </span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="statement_4" value="1">
                                        <span class="form-check-label">
                                              NO
                                            </span>
                                    </label>
                                    <span class="text-justify">Informaré inmediatamente a mi supervisor o jefe de Instalación en caso de presentar uno o más de los síntomas anteriormente descritos.</span>

                                </div>
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-primary">Enviar declaración</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! makeValidation('statement-form','statement','location.href="/declaracion-enviada";') !!}

@endsection
