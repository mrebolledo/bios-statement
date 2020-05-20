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
                            <h1 class="text-center">Error!</h1>
                            <br><br><br>
                            <span class="alert alert-danger">
                                El código ingresado no existe en nuestros registros. favor intentar con un código válido.
                            </span>
                            <br><br><br><br>

                            <a href="/verificar-codigo" class="btn btn-link"><i class="fas fa-arrow-left"></i> Volver a verificación</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
