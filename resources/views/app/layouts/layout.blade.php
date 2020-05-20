@extends('app.main')

@section('layout-content')
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-2">
        <div class="layout-inner">

            <!-- Layout sidenav -->
        @include('app.partials.layout-sidenav')

        <!-- Layout container -->
            <div class="layout-container">
                <!-- Layout navbar -->
            @include('app.partials.layout-navbar')

            <!-- Layout content -->
                <div class="layout-content">

                    <!-- Content -->
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="py-3 mb-4">
                            <h4 class="font-weight-bold mb-2">
                                <i class="fas @yield('icon')"></i> @yield('title')
                                @hasSection('page-buttons')
                                    <span class="pull-right">@yield('page-buttons')</span>
                                @endif
                            </h4>
                        </div>
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <!-- Layout footer -->
                    @include('app.partials.layout-footer')
                </div>
                <!-- Layout content -->

            </div>
            <!-- / Layout container -->

        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
@endsection
