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
                            <li class="breadcrumb-item active" active aria-current="page">Crear Categoría</li>
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
    <form action="{{ route('admin.Courses.store') }}" method="post" class="form" enctype="multipart/form-data">
        <div class="card">
            <div class="card-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                        value="{{ old('name') }}">
                </div>
                {{-- <div class="form-group">
                            <label for="description">Descripción </label>
                            <textarea class="form-control ckeditor" name="description" id="descripción" rows="5"
                                placeholder="Descripción">{{ old('description') }}</textarea>
            </div> --}}
            <div class="form-group">
                <label for="cover">Cover </label>
                <input type="file" name="cover" id="cover" class="form-control">
            </div>
            <div class="form-group">
                <label for="status">Estado </label>
                <select name="status" id="status" class="form-control">
                    <option value="0">Deshabilitado</option>
                    <option value="1">Habilitado</option>
                </select>


            </div>
            <div class="card-footer text-right">
                <div class="btn-group">
                    <a href="{{ route('admin.Courses.index') }}" class="btn btn-default btn-sm">Regresar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                </div>
            </div>
        </div>
        </div>
    </form>
</section>
@endsection