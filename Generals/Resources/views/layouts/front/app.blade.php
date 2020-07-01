<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>fvn</title>
    <link rel="icon" href="{{asset('img/fvn/logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/front/app.css')}}">
    @yield('styles')
</head>

<body>
    @include('generals::layouts.front.header')
    @yield('content')
    @include('generals::layouts.front.footer')
</body>
<script src="{{ asset('js/front/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
@yield('scripts')

</html>