<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ url('/images/caricon.png') }}" type="image/png" sizes="16x16">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GALLEXOTIC | CAR RENTAL</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .nav-control {
            margin: 9% 0 9% 0;
            padding: 5%;
        }

        .nav-control:hover {
            text-decoration: none;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app">
        <div class="wrapper">

            <!-- Main Header Navbar for Admin -->
            @include('partials._adminMainHeader')

            <!-- Main Sidebar for Admin -->
            @include('partials._adminMainSidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @include('partials._breadcrumb')

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">

                        @yield('content')
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Admin Footer -->
            @include('partials._adminFooter')

            <!-- Control Sidebar -->
            @include('partials._adminControlSidebar')
            <!-- /.control-sidebar -->
        </div>
    </div>
</body>


</html>