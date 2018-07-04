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
    <link href="{{ asset('static/css/app.319de3653bd71744db78a9ce2a48df03.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <router-view></router-view>
</div>

<script src="{{ asset('static/js/manifest.3f16dd889e8c85dce632.js') }}" defer></script>
<script src="{{ asset('static/js/vendor.e0423f40b9712e2b9c86.js') }}" defer></script>
<script src="{{ asset('static/js/app.c6a7abed3f9a91a90259.js') }}" defer></script>


</body>
</html>