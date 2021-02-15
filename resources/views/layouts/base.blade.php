<?php setlocale(LC_TIME, 'id_ID'); ?>
<!DOCTYPE html>
<html lang="id" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        <meta name="description" content="Description">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('img/logo-jahit.png') }}">

        <title>Jahit | @yield('title')</title>

        <link rel="stylesheet" href="{{ asset('lib/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

        <link rel="stylesheet" href="{{ asset('css/base.css') }}">
        <link rel="stylesheet" href="{{ asset('css/nav.css') }}">

        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,531;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,531;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        @yield('extra-fonts')
        @yield('prerender-js')
        @yield('extra-css')
    </head>
    <body>
        @include('layouts/_nav')
        @yield('content')
        @include('layouts/modalImageFullscreen')
        <script src="{{ asset('lib/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('lib/popper.min.js') }}"></script>
        <script src="{{ asset('lib/bootstrap.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
        
        <script src="{{ asset('js/base.js') }}"></script>
        <script src="{{ asset('js/nav.js') }}"></script>
        @yield('extra-js')
    </body>
</html>
