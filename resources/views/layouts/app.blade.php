<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Trello Laravel</title>

    <!-- Styles(local secure_asset=>asset to) -->
    @include('layouts.head')
    @yield('style')
</head>
<body>
<!-- Show headers only if you are logged in --->

        <x-header/>

    @yield('content')
    <!-- footer -->
@include('layouts.footer')
<!--Script js-->
@include('layouts.script')
</body>
</html>
