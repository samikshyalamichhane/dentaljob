<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title> @isset($title) {{ $title }} @endisset</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{ asset('assets/common.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/main.css') }}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="{{ asset('assets/admin/css/pages/auth-light.css') }}" rel="stylesheet" />

    @stack('styles')
    {{ $styles ?? null }}
</head>

<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link" href="/">
                {{-- {{ $dashboard_composer->site_name }} --}}
            </a>
        </div>
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
    <!-- BEGIN PAGA BACKDROPS-->
    <!-- <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div> -->
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="{{ asset('assets/admin/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/vendors/popper.js/dist/umd/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript">
    </script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="{{ asset('assets/admin/vendors/jquery-validation/dist/jquery.validate.min.js') }}"
        type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="{{ asset('assets/common.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/app.js') }}" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        });

        $('form').submit(function(e) {
            $('form button').attr('disabled', true);
        });

    </script>

    @stack('scripts')
    {{ $scripts ?? null }}
</body>

</html>
