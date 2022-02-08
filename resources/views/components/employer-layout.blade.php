<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Employer @isset($title) ~ {{ $title }} @endisset </title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('/assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/admin/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />

    <!-- PLUGINS STYLES-->
    <link href="{{ asset('/assets/admin/vendors/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{ asset('/assets/admin/css/main.min.css') }}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <script src="{{ asset('/assets/admin/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <style type="text/css">
        .ibox {
            border-radius: 10px;
        }

        .form-control {
            box-shadow: 0 0 #0000, 0 0 #0000, 0 0 #0000, 0 0 #0000, 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
            border-radius: .375rem !important;
            --tw-border-opacity: 1;
            border-color: rgba(209, 213, 219, var(--tw-border-opacity)) !important;
            padding-top: .5rem;
            padding-right: .75rem;
            padding-bottom: .5rem;
            padding-left: .75rem;
            font-size: 1rem;
            line-height: 1.5rem;
        }

        .modal-dialog {
            position: relative;
            display: table;
            overflow-y: auto;
            overflow-x: auto;
            min-width: 300px;
        }

        .jcrop-keymgr {
            opacity: 0 !important;
        }

        button {
            background: none;
            border: none;
            padding: 0;
            margin: 0;
        }

        .header .dropdown-user a.dropdown-toggle img {
            height: 30px;
            object-fit: cover;
            border: 1px solid #847a7a;
            padding: 4px;
        }

        label,
        *::placeholder,
        ul li,
        h1.page-title {
            text-transform: capitalize;
        }

    </style>

    @stack('styles')
    {{ $styles ?? null }}

</head>

<body class="fixed-navbar">
    <div class="page-wrapper">

        <header class="header">
            <div class="page-brand">
                <a class="link" href="{{ route('employer.getEmployerDashboard') }}">
                    <span class="brand">{{ $dashboard_composer->site_name }}</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>

                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">

                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <span></span>{{ auth()->user()->name }}<i class="fa fa-angle-down m-l-5"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="{{ route('employer.employerLogout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('employer.employerLogout') }}"
                                style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>

        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex align-items-center">
                    @isset($dashboard_composer->logo_left)
                        <div>
                            <img src="{{ asset('/images/main/' . $dashboard_composer->logo_left) }}" class="rounded"
                                width="45px" />
                        </div>
                    @endisset
                    <div class="admin-info">
                        <div class="font-strong">{{ auth()->user()->name }}</div>
                    </div>
                </div>
                <ul class="side-menu metismenu">
                    <li class="heading">Menu</li>
                    <li>
                        <a href="{{ route('employer.getEmployerDashboard') }}"><i
                                class="sidebar-item-icon fa fa-globe"></i>
                            <span class="nav-label">Dashboard</span></a>
                    </li>

                    <li>
                        <a href="{{ route('employer.employer.edit', auth()->user()->employer->id) }}"><i
                                class="sidebar-item-icon fa fa-globe"></i>
                            <span class="nav-label">Employer Detail</span></a>
                    </li>

                    <li>
                        <a href="javascript:;">
                            <i class="sidebar-item-icon fa fa-sitemap"></i>
                            <span class="nav-label">Job</span>
                            <i class="fa fa-angle-left arrow"></i>
                        </a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="{{ route('employer.job.index') }}">
                                    <span class="fa fa-plus"></span>
                                    All lists
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('employer.job.create') }}">
                                    <span class="fa fa-plus"></span>
                                    Add new
                                </a>
                            </li>
                        </ul>
                    </li>

                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="content-wrapper ">
            <div class="my-3">
                @if (count($errors) > 0)
                    <x-error-message />
                @endif

                @if (session('message'))
                    <x-alert type="success" message="{{ session('message') }}" />
                @endif
            </div>
            {{ $slot }}

        </div>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->

    <script src="{{ asset('/assets/admin/vendors/popper.js/dist/umd/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/admin/vendors/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript">
    </script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="{{ asset('/assets/admin/vendors/chart.js/dist/Chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/admin/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/admin/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"
        type="text/javascript">
    </script>
    <script src="{{ asset('/assets/admin/vendors/jvectormap/jquery-jvectormap-us-aea-en.js') }}" type="text/javascript">
    </script>
    <!-- CORE SCRIPTS-->
    <script src="{{ asset('/assets/admin/js/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/admin/vendors/metisMenu/dist/metisMenu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/common.js') }}"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="{{ asset('/assets/admin/js/scripts/dashboard_1_demo.js') }}" type="text/javascript"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $('form').submit(function(e) {
            $('form button').attr('disabled', true);
        });

        $(document).ready(function() {
            $(".alertMessage").delay(2000).slideUp(500);
        });

    </script>

    @stack('scripts')
    {{ $scripts ?? null }}

</body>

</html>


{{-- <li>
    <a href="javascript:;">
        <i class="sidebar-item-icon fa fa-sitemap"></i>
        <span class="nav-label">blog</span>
        <i class="fa fa-angle-left arrow"></i>
    </a>
    <ul class="nav-2-level collapse">
        <li>
            <a href="">
                <span class="fa fa-plus"></span>
                All lists
            </a>
        </li>
        <li>
            <a href="">
                <span class="fa fa-plus"></span>
                Add new
            </a>
        </li>

    </ul>
</li> --}}
