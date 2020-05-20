<!-- Layout navbar -->
<nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-white container-p-x" id="layout-navbar">

    <!-- Brand demo (see resources/assets/css/demo.css) -->
    <a href="/" class="navbar-brand app-brand demo d-lg-none py-0 mr-4">
        <span class="app-brand-logo demo">
            <img src="{{ asset('images/logo-mini.png') }}" alt="C"  width="120%">
        </span>
        <span class="app-brand-text demo font-weight-bolder ml-2">{{ config('app.name') }}</span>
    </a>

    @empty($hide_layout_sidenav_toggle)
    <!-- Sidenav toggle (see resources/assets/css/demo.css) -->
    <div class="layout-sidenav-toggle navbar-nav d-lg-none align-items-lg-center mr-auto">
        <a class="nav-item nav-link px-0 mr-lg-4" href="javascript:void(0)">
            <i class="ion ion-md-menu text-large align-middle"></i>
        </a>
    </div>
    @endempty

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#layout-navbar-collapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="layout-navbar-collapse">
        <!-- Divider -->
        <hr class="d-lg-none w-100 my-2">

        <div class="navbar-nav align-items-lg-center">
            <!-- Search -->

        </div>

        <div class="navbar-nav align-items-lg-center ml-auto">


            <!-- Divider -->
            <div class="nav-item d-none d-lg-block text-big font-weight-light line-height-1 opacity-25 mr-3 ml-1">|</div>

            <div class="demo-navbar-user nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                    <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                        <img src="{{ asset('images/user.png') }}" alt class="d-block ui-w-30 rounded-circle">
                        <span class="px-1 mr-lg-2 ml-2 ml-lg-0">{{ auth()->user()->full_name }}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="javascript:void(0)" class="dropdown-item"><i class="ion ion-ios-person text-lightest"></i> &nbsp; My profile</a>
                    <a href="javascript:void(0)" class="dropdown-item"><i class="ion ion-ios-mail text-lightest"></i> &nbsp; Messages</a>
                    <a href="javascript:void(0)" class="dropdown-item"><i class="ion ion-md-settings text-lightest"></i> &nbsp; Account settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"><i class="ion ion-ios-log-out text-danger"></i> &nbsp; Log Out</a>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- / Layout navbar -->
