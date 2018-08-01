<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('static/css/app.7fe19f6bfdd60ec28af3f4c7d8e24f2a.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <router-view></router-view>
</div>

<script src="{{ asset('static/js/manifest.a17c9f8da1856b9d06cd.js') }}" defer></script>
<script src="{{ asset('static/js/vendor.b514092e71c5d6930cb8.js') }}" defer></script>
<script src="{{ asset('static/js/app.d88f11b672e1d23b14ea.js') }}" defer></script>


</body>
</html>