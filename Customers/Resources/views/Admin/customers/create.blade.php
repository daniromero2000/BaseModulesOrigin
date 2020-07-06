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
                            <li class="breadcrumb-item " aria-current="page"><a
                                    href="{{ route('admin.customers.index') }}">Clientes</a></li>
                            <li class="breadcrumb-item active">Crear Cliente</li>
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
    <div class="card">
        <form action="{{ route('admin.customers.store') }}" method="post" class="form">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Crear Cliente</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre"
                                    class="form-control" value="{{ old('name') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="last_name">Apellido</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="last_name" id="last_name" validation-pattern="name"
                                    placeholder="Apellido" class="form-control" value="{{ old('last_name') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="birthday">Fecha de Nacimiento</label>
                            <div class="input-group input-group-merge">
                                <input type="date" name="birthday" min="1900-01-01" max="<?php echo $fechaMayorEdad;?>"
                                    id="birthday" placeholder="Fecha Nacimiento" class="form-control"
                                    value="{{ old('birthday') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="cities" class="form-group">
                            <label class="form-control-label" for="city_id">Ciudad de Nacimiento</label>
                            <div class="input-group">
                                <select name="city_id" id="city_id" class="form-control" enabled>
                                    @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="cities" class="form-group">
                            <label class="form-control-label" for="scholarity_id">Escolaridad</label>
                            <div class="input-group">
                                <select name="scholarity_id" id="scholarity_id" class="form-control select2">
                                    @if(!empty($scholarities))
                                    @foreach($scholarities as $scholarity)
                                    <option value="{{ $scholarity->id }}">{{ $scholarity->scholarity }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="cities" class="form-group">
                            <label class="form-control-label" for="civil_status_id">Estado Civil</label>
                            <div class="input-group">
                                <select name="civil_status_id" id="civil_status_id" class="form-control select2">
                                    @foreach($civil_statuses as $civil_status)
                                    <option value="{{ $civil_status->id }}">{{ $civil_status->civil_status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="cities" class="form-group">
                            <label class="form-control-label" for="customer_channel_id">Lead</label>
                            <div class="input-group">
                                <select name="customer_channel_id" id="customer_channel_id" class="form-control select2">
                                    @foreach($customer_channels as $customer_channel)
                                    <option value="{{ $customer_channel->id }}">{{ $customer_channel->channel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="genre_id">Genero <span class="text-danger">*</span></label>
                            <ul class="list-unstyled list-inline">
                                @if(!empty($genres))
                                @foreach($genres as $genre)
                                <li>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="genre_id" id="genre_id" value="{{ $genre->id }}">
                                            {{ $genre->genre }}
                                        </label>
                                    </div>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.customers.index') }}" class="btn btn-default btn-sm">Regresar</a>
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
            </div>
        </form>
    </div>


</section>

@endsection