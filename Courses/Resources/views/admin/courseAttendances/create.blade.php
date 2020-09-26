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
                            <li class="breadcrumb-item active" active aria-current="page">Crear Curso</li>
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
    <form action="{{ route('admin.courses.store') }}" method="post" class="form" enctype="multipart/form-data">
        <div class="card">
            <div class="card-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="form-control-label" for="name">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                        value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label class="form-control-label" for="link">Enlace</label>
                    <input type="text" name="link" id="link" placeholder="Enlace" class="form-control"
                        value="{{ old('link') }}">
                </div>
                {{-- <div class="form-group">
                            <label class="form-control-label" for="description">Descripción </label>
                            <textarea class="form-control ckeditor" name="description" id="descripción" rows="5"
                                placeholder="Descripción">{{ old('description') }}</textarea>
            </div> --}}
            <div class="form-group">
                <label class="form-control-label" for="cover">Cover </label>
                <input type="file" name="cover" id="cover" class="form-control">
            </div>

            <div class="form-group">
                <label class="form-control-label" for="img_welcome">Imagen de cabecera </label>
                <input type="file" name="img_welcome" id="img_welcome" class="form-control">
            </div>

            <div class="form-group">
                <label class="form-control-label" for="img_button">Imagen del Boton </label>
                <input type="file" name="img_button" id="img_button" class="form-control">
            </div>

            <div class="form-group">
                <label class="form-control-label" for="img_footer">Imagen final </label>
                <input type="file" name="img_footer" id="img_footer" class="form-control">
            </div>

            <div class="form-group">
                <label class="form-control-label" for="status">Estado </label>
                <select name="status" id="status" class="form-control">
                    <option value="0">Deshabilitado</option>
                    <option value="1">Habilitado</option>
                </select>


            </div>
            <div class="card-footer text-right">
                <div class="btn-group">
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-default btn-sm">Regresar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                </div>
            </div>
        </div>
        </div>
    </form>
</section>
@endsection