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
                            <h1 class="text-center">DECLARACION JURADA COVID-19</h1>
                            <br><br><br>
                            <span class="alert alert-success">
                                Declaración enviada con éxito.
                            </span>
                            <br><br><br><br>

                            <a href="/declaracion" class="btn btn-link"><i class="fas fa-arrow-left"></i> Volver al formulario</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
