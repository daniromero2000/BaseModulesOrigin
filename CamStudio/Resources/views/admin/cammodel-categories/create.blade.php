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
    <div class="box">
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="post" class="form"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="parent">Categoría Padre</label>
                            <select name="parent" id="parent" class="form-control select2">
                                <option value="">-- Seleccionar --</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                                value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción </label>
                            <textarea class="form-control ckeditor" name="description" id="descripción" rows="5"
                                placeholder="Descripción">{{ old('description') }}</textarea>
                        </div>
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

                            <div class="box-footer">
                                <div class="btn-group">
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Regresar</a>
                                    <button type="submit" class="btn btn-primary">Crear</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection