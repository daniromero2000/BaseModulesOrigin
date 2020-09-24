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
                            <li class="breadcrumb-item active" active aria-current="page">Crear Valor de Atributo</li>
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
    <div class="box">
        <form action="{{ route('admin.students.store') }}" method="post" class="form">
            <div class="box-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="value">Cargar archivo<span class="text-danger">*</span></label>
                                    <input type="file" name="value" id="value" placeholder="Archivo Carga"
                                        class="form-control" value="{!! old('value')  !!}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="btn-group">

                    <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
