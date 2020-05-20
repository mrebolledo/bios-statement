@extends('app.layouts.layout-blank')

@section('styles')
    <!-- Page -->
    <link rel="stylesheet" href="{{ mix('/vendor/css/pages/authentication.css') }}">
@endsection

@section('content')
    <div class="authentication-wrapper authentication-3">
        <div class="authentication-inner">

            <!-- Side container -->
            <!-- Do not display the container on extra small, small and medium screens -->
            <div class="d-none d-lg-flex col-lg-8 align-items-center ui-bg-cover ui-bg-overlay-container p-3" style="background-image: url('/img/bg/21.jpg');">
                <div class="ui-bg-overlay bg-dark opacity-50"></div>

                <!-- Text -->
                <div class="w-100 text-white px-5">
                    <h1 class="display-2 font-weight-bolder mb-4">{{ config('app.name') }}</h1>
                    <div class="text-large font-weight-light">
                        Sistema de Bio seguridad
                    </div>
                </div>
                <!-- /.Text -->
            </div>
            <!-- / Side container -->

            <!-- Form container -->
            <div class="d-flex col-lg-4 align-items-center bg-white p-5">
                <!-- Inner container -->
                <!-- Have to add `.d-flex` to control width via `.col-*` classes -->
                <div class="d-flex col-sm-7 col-md-5 col-lg-12 px-0 px-xl-4 mx-auto">
                    <div class="w-100">

                        <!-- Logo -->
                        <div class="d-flex justify-content-center mt-n6">
                            <img src="{{ asset('images/logo.png') }}"  class="w-75 h-75">
                        </div>
                        <!-- / Logo -->
                        <h4 class="text-center text-lighter font-weight-normal mt-3 mb-0">@yield('auth-title')</h4>

                        @yield('auth-content')


                    </div>
                </div>
            </div>
            <!-- / Form container -->

        </div>
    </div>
@endsection
