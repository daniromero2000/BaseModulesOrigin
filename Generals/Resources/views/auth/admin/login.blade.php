<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="subject" content="">
    <meta name="copyright" content="">
    <meta name="language" content="ES">
    <meta name="classification" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"
        type='text/css'>
    <link rel="icon" href="{{asset('modules/generals/argonTemplate/img/icons/shop.png')}}" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="{{asset('modules/generals/argonTemplate/resources/nucleo/css/nucleo.css')}}"
        type="text/css">
    <link rel="stylesheet"
        href="{{asset('modules/generals/argonTemplate/resources/@fortawesome/fontawesome-free/css/all.min.css')}}"
        type="text/css">
    <link rel="stylesheet" href="{{asset('modules/generals/argonTemplate/css/argon.css?v=1.1.0')}}" type="text/css">

</head>

<body class="g-sidenav-show g-sidenav-pinned" style=" background-color: #e6e9ec !important; ">
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-5">
            <div class="container">
                @include('layouts.admin.welcome')
                <div class="separator separator-bottom separator-skew zindex-100">
                    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                        xmlns="http://www.w3.org/2000/svg">
                        <polygon style=" fill: #e6e9ec; " points="2560 0 2560 100 0 100"></polygon>
                    </svg>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-white border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="w-100 d-flex">
                                <img src="{{asset('modules/generals/argonTemplate/img/brand/logo_smart.png')}}"
                                    class="navbar-brand-img mx-auto mb-3" alt="Logo_smart"
                                    style="max-width: 200px;">
                            </div>
                            <div class="text-center text-muted mb-4">
                                <h2 class="">Inicia Sesión</h2>
                            </div>
                            <form action="{{ route('admin.login') }}" method="post">@csrf<div
                                    class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control px-2" autocomplete="false" placeholder="Email"
                                                type="email" name="email" value="{{ old('email') }}" required>
                                        </div>

                                        @if ($errors)
                                        <span class="help-block text-warning text-sm">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div
                                        class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input type="password" name="password" class="form-control px-2"
                                                placeholder="Contraseña" required>
                                        </div>
                                        @if ($errors->has('password'))
                                        <span class="help-block text-warning text-sm">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary mt-4">Ingresar</button>
                                    </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</body>
<script src="{{asset('modules/generals/argonTemplate/js/argon.js?v=1.1.0')}}"></script>

</html>