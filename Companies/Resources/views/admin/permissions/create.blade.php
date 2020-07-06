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
                            <li class="breadcrumb-item active" active aria-current="page">Crear Permiso</li>
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

    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('admin.permissions.store') }}" method="post" class="form">
            <div class="box-body">
                @csrf
                <h1>Crear Módulo</h1>
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-check"></i>
                        </div>
                        <input type="text" name="name" id="name" placeholder="Nombre" validation-pattern="name"
                            class="form-control" value="{{ old('name') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="display_name">Nombre a mostrar <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-eye"></i>
                        </div>
                        <input type="text" name="display_name" id="display_name" placeholder="Nombre a mostrar"
                            validation-pattern="name" class="form-control" value="{{ old('display_name') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="icon">Ícono <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fas fa-grip-horizontal"></i>
                        </div>
                        <input type="text" name="icon" id="icon" placeholder="Ícono" class="form-control"
                            value="{{ old('icon') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="icon">Descripción</label>
                    <textarea name="description" id="description" class="form-control" validation-pattern="text"
                        rows="3">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="box-footer">
                <div class="btn-group">
                    <div class="btn-group">
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-default">Regresar</a>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection