<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Portfolio - TechExpertsBD</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
        <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

        <!-- Vendor CSS Files -->
        <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="{{ asset('assets/css/all.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>

        <div id="preloader"></div>
        <a
        href="javascript:void(0)"
        onclick="window.scrollTo(0,0)"
        class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
        </a>
        
        <!-- Vue JS -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- All JS -->
        <script src="{{ asset('assets/js/all.js') }}"></script>
    </body>
</html>
