@extends('generals::layouts.admin.app')
@section('styles')
    <style>
        .relative {
            position: relative;
        }

        .remove-img {
            position: absolute;
            top: 5px;
            width: 29px;
            right: 5px;
        }

        @media (max-width: 700px) {
            .remove-img {
                width: 0px;
                padding-right: 12px;
                right: 0px;
                font-size: 8px;
            }
        }

    </style>
@endsection
@section('header')
    <div class="header pb-2">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" active aria-current="page">Editar Categoría</li>
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
            <form action="{{ route('admin.bannerManagement.update', $category->id) }}" method="post" class="form"
                enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7 col-lg-6">
                            <input type="hidden" name="_method" value="put">
                            <h2 class="mb-3">Crear {{ $category->name }}</h2>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nombre <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                                    value="{!! $category->name ?: old('name') !!}">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="alt">Descripción <small>(ALT)</small> </label>
                                <textarea class="form-control ckeditor" name="alt" id="alt" rows="2"
                                    placeholder="Descripción">{!! $category->alt ?: old('alt') !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="status">Estado</label>
                                <div class="input-group">
                                    <select name="is_active" id="is_active" class="form-control select2">
                                        <option value="0" @if ($category->is_active == 0 || old('is_active') == 0) selected="selected" @endif>inactivo
                                        </option>
                                        <option value="1" @if ($category->is_active == 1 || old('is_active') == 1) selected="selected" @endif>Activo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-lg-6">
                            @if (isset($category->src))
                                <div class="card-body">
                                    <div class="d-flex" style=" position: relative; ">
                                        <img src="{{ asset("storage/$category->src") }}" alt="{{ $category->slug }}"
                                            class=" mx-auto img-fluid" style="border-radius: 15px;max-height: 330px;">
                                    </div>
                                </div>

                            @endif
                            <div class="form-group">
                                <label class="form-control-label" for="src">Banner </label>
                                <input type="file" name="src" id="src" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <a href="{{ route('admin.bannerManagement.index') }}" class="btn btn-default btn-sm">Regresar</a>
                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
