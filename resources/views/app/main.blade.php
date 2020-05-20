<!DOCTYPE html>

<html lang="en" class="default-style">
<head>
    <title>DBS CMATIK</title>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="icon" href="{{ asset('images/logo-mini.png') }}" sizes="192x192" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{ mix('/vendor/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/fonts/ionicons.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/fonts/linearicons.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/fonts/open-iconic.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/fonts/pe-icon-7-stroke.css') }}">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="{{ mix('/vendor/css/rtl/bootstrap.css') }}" class="theme-settings-bootstrap-css">
    <link rel="stylesheet" href="{{ mix('/vendor/css/rtl/appwork.css') }}" class="theme-settings-appwork-css">
    <link rel="stylesheet" href="{{ mix('/vendor/css/rtl/theme-cotton.css') }}" class="theme-settings-theme-css">
    <link rel="stylesheet" href="{{ mix('/vendor/css/rtl/colors.css') }}" class="theme-settings-colors-css">
    <link rel="stylesheet" href="{{ mix('/vendor/css/rtl/uikit.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/demo.css') }}">

    <!-- Load polyfills -->
    <script src="{{ mix('/vendor/js/polyfills.js') }}"></script>
    <script>document['documentMode']===10&&document.write('<script src="https://polyfill.io/v3/polyfill.min.js?features=Intl.~locale.en"><\/script>')</script>

    <script src="{{ mix('/vendor/js/material-ripple.js') }}"></script>
    <script src="{{ mix('/vendor/js/layout-helpers.js') }}"></script>

    <!-- Theme settings -->
    <!-- This file MUST be included after core stylesheets and layout-helpers.js in the <head> section -->


    <!-- Core scripts -->
    <script src="{{ mix('/vendor/js/pace.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Libs -->
    <link rel="stylesheet" href="{{ mix('/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/toastr/toastr.css')}}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/sweetalert2/sweetalert2.css') }}">
    @yield('styles')
</head>
<body @hasSection('bg-color') class="@yield('bg-color')" @endif>
<div class="page-loader"><div class="bg-primary"></div></div>

@yield('layout-content')

<!-- Core scripts -->
<script src="{{ mix('/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ mix('/vendor/js/bootstrap.js') }}"></script>
<script src="{{ mix('/vendor/js/sidenav.js') }}"></script>
<script src="{{mix('/vendor/libs/toastr/toastr.js')}}" ></script>
<script src="{{ mix('/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<!-- Scripts -->
<script src="{{ mix('/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ mix('/js/demo.js') }}"></script>
<script src="{{ asset('js/forms.js') }}"></script>

<div class="modal fadeindown" id="remoteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


        </div>
    </div>
</div>
@yield('scripts')
<script>
    $(document).ready(function() {

    });

    let remoteModal = $('#remoteModal');
    remoteModal.on('show.bs.modal', function (e) {
        $(this).find('.modal-content').load(e.relatedTarget.href);
    });
    remoteModal.on('hidden.bs.modal', function (e) {
        $('#remoteModal .modal-content').html('');
        $('.dtp').remove();
    });
</script>
</body>
</html>
