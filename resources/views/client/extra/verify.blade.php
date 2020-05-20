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
                            <h1 class="text-center">Verificar declaración</h1>
                            <p class="text-justify">
                                Puedes verificar una declaración realizada con el código enviado por correo.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-8 mx-auto">
                            <form class="mb-xl-5 mt-5" id="statement-form" method="post" action="/verificar-codigo">
                                @csrf
                                <div class="form-group">
                                    <label for="rut">Ingrese su Código</label>
                                    <input type="text" id="code" name="code" class="form-control input-lg" required >
                                </div>

                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-primary">Verificar Código</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
