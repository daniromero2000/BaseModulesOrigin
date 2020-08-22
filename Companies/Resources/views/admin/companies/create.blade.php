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
                            <li class="breadcrumb-item " active aria-current="page">Compañias</li>
                            <li class="breadcrumb-item active">Crear Compañias</li>
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
        <form action="{{ route('admin.companies.store') }}" method="post" class="form" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Crear Compañia</h2>
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
                            <label class="form-control-label"
                                for="identification">Número Identificación</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" name="identification" id="identification"
                                        placeholder="Número de Identificación" validation-pattern="text"
                                        class="form-control"
                                        value="{{ old('identification') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label"
                                for="company_type">Tipo de Identificación</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                                class="fa fa-clock-o"></i></span>
                                </div>
                                <select name="company_type" id="company_type"
                                        class="form-control">
                                    <option selected="selected" value="1">
                                        Natural</option>
                                    <option value="2">Jurídica
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="cities" class="form-group">
                            <label class="form-control-label" for="country_id">País</label>
                            <div class="input-group">
                                <select name="country_id" id="country_id" class="form-control" enabled>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label"
                                for="base_currency_id">Tipo de Moneda</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i
                                                class="fa fa-clock-o"></i></span>
                                </div>
                                <select name="base_currency_id" id="base_currency_id"
                                        class="form-control">
                                    <option selected="selected" value="1">
                                        US Dolar</option>
                                    <option value="2">Euro
                                    </option>
                                    <option value="3">Colombian Peso
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="logo">Logo</label>
                            <input type="file" name="logo" id="logo" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-control-label" for="description">Descripción </label>
                            <textarea class="form-control ckeditor" name="description" id="description" rows="5"
                                placeholder="Descripción">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                <a href="{{ route('admin.companies.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>
</section>
@endsection