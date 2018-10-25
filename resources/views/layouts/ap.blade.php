<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('star_admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('star_admin/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('star_admin/vendors/css/vendor.bundle.addons.css') }}">
    <link rel="stylesheet" href="{{ asset('star_admin/vendors/icheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('star_admin/vendors/iconfonts/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('star_admin/css/style.css') }}">
</head>
<body>
    <div id="app">       

        <div class="container-scroller">    

            @include('includes/header')

            <div class="container-fluid page-body-wrapper">      
      
                @include('includes/sidebar')

                @yield('content')

                @include('includes/footer')
        
            </div>     
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('star_admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('star_admin/vendors/js/vendor.bundle.addons.js') }}"></script>
    <script src="{{ asset('star_admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('star_admin/js/misc.js') }}"></script>
    <script src="{{ asset('star_admin/js/dashboard.js') }}"></script>
</body>
</html>
