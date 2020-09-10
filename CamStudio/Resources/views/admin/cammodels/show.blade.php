@php
$fechaActual = strtotime(date("Y-m-d"));
$fechaMayorEdad = date("Y-m-d", strtotime("-18 years", $fechaActual));
@endphp
@extends('generals::layouts.admin.app')
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Modelo</a>
                            </li>
                            {{-- <li class="breadcrumb-item active" aria-current="page">{{$employee->name}}
                            {{$employee->last_name}}</li> --}}
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="header pb-6 d-flex align-items-center"
        style="min-height: 500px; background-image: url({{asset('modules/generals/argonTemplate/img/theme/profile-cover.jpg')}}); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
            <div class="row">
                <div class="col-lg-7 col-md-10">
                    <h1 class="display-2 text-white">Hola {{$cammodel->nickname}}</h1>
                    <p class="text-white mt-0 mb-5">Esta es tu página de perfil de modelo. aqui puedes editar todos tus
                        datos como modelo.</p>
                    {{-- <a href="#!" class="btn btn-neutral">Edit profile</a> --}}
                </div>
            </div>
        </div>
    </div>
    <form action="">
        <div class="container-fluid mt--6">
            <div class="row">
                <div class="col-xl-4 order-xl-2">
                    @include('camstudio::admin.layouts.generals')
                </div>
                <div class="col-xl-8 order-xl-1">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">Edit profile </h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form>
                                <h6 class="heading-small text-muted mb-4">Informacion</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="nickname">Nombre</label>
                                                <input type="text" id="nickname" name="nickname" class="form-control"
                                                    placeholder="Nombre" value="{{$cammodel->nickname}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="height">Estatura</label>
                                                <input type="text" id="height" value="{{$cammodel->height}}"
                                                    name="height" class="form-control" placeholder="1.50">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="weight">Peso / Kg</label>
                                                <input type="text" id="weight" name="weight"
                                                    value="{{$cammodel->weight}}" class="form-control" placeholder="50">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="breast_cup_size">Tamaño de
                                                    senos</label>
                                                <input type="text" id="breast_cup_size" name="breast_cup_size"
                                                    class="form-control" placeholder="38B"
                                                    value="{{$cammodel->breast_cup_size}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="fake_age">Edad</label>
                                                <input type="text" id="fake_age" value="{{$cammodel->fake_age}}"
                                                    class="form-control" placeholder="50">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="breast_cup_size">Tamaño de
                                                    senos</label>
                                                <input type="text" id="breast_cup_size" name="breast_cup_size"
                                                    class="form-control" placeholder="38B"
                                                    value="{{$cammodel->breast_cup_size}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Gustos y disgustos</label>
                                                <textarea rows="4" name="likes_dislikes" class="form-control"
                                                    placeholder="Mis Gustos son..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <!-- Address -->
                                <h6 class="heading-small text-muted mb-4">Restricciones</h6>
                                <div class="pl-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Mis reglas</label>
                                                <textarea rows="4" name="my_rules" class="form-control"
                                                    placeholder="Mis reglas son..."></textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Country</label>
                                            <input type="text" id="input-country" class="form-control"
                                                placeholder="Country" value="United States">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-country">Postal code</label>
                                            <input type="number" id="input-postal-code" class="form-control"
                                                placeholder="Postal code">
                                        </div>
                                    </div> --}}
                                    </div>
                                </div>
                                <hr class="my-4">
                                <!-- Description -->
                                <h6 class="heading-small text-muted mb-4">About me</h6>
                                <div class="pl-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">About Me</label>
                                        <textarea rows="4" name="about_me" class="form-control"
                                            placeholder="Unas palabras sobre ti..."></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-2 text-right">
                <a href="{{ route('admin.employees.index') }}" class="btn btn-default btn-sm">Regresar</a>
                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
            </div>
        </div>

    </form>


    {{-- @include('camstudio::admin.layouts.edit_employee', ['data' => $employee])
    @include('camstudio::admin.layouts.add_address_modal')
    @include('camstudio::admin.layouts.add_emergencycontact_modal')
    @include('camstudio::admin.layouts.add_email_modal')
    @include('camstudio::admin.layouts.add_phone_modal')
    @include('camstudio::admin.layouts.add_identity_modal')
    @include('camstudio::admin.layouts.add_comment_modal')
    @include('camstudio::admin.layouts.add_eps_modal')
    @include('camstudio::admin.layouts.add_profession_modal') --}}
</section>
@endsection