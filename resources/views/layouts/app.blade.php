<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--CSRF Token-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Page Title-->
    <title>@yield('page-title')</title>
    
    <!--Favicon-->
    <link rel="icon" type="image/png" href="{{ asset('storage/favicon.ico') }}"> 
    
    <!--CSS Files Dependencies-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('additional-css')

    <!--[if lt IE 9]>
	<script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>	
    <![endif]-->
    
</head>
<body>
    @yield('body')

    <!--Javascript Dependencies-->
    <script type="text/javascript" src="{{ asset('js/manifest.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vendor.core.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core.js') }}"></script>
    @yield('additional-scripts')
</body>
</html>