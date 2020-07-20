@extends('generals::layouts.admin.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('front/carousel/glider.css')}}">
<script src="{{ asset('front/carousel/glider.js')}}"></script>
<script src="{{ asset('admin/js/carousel.js')}}"></script>
<style type="text/css">
    .info-tooltip {
        position: absolute;
        top: 3px;
        right: 18px;
        border-radius: 20px;
        background: #5e72e4;
        width: 18px;
        cursor: pointer;
        font-size: 12px;
        text-decoration: none;
        color: white !important;
    }

    .relative {
        position: relative;
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
                            <li class="breadcrumb-item"><a href="/admin/products">Productos</a></li>
                            <li class="breadcrumb-item active" active aria-current="page">Crear Producto</li>
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
        <form action="{{ route('admin.products.store') }}" method="post" class="form" enctype="multipart/form-data">
            <div class="card-body">
                {{ csrf_field() }}
                <div class="col pl-0 mb-3">
                    <h2>Crear Producto</h2>
                </div>
                <div class="row">
                    <div class="col-md-7 col-lg-6">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="form-control-label" for="sku">SKU <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="sku" id="sku" placeholder="xxxxx" class="form-control"
                                        value="{{ old('sku') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="quantity">Cantidad <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="quantity" id="quantity" placeholder="Cantidad"
                                        class="form-control" value="{{ old('quantity') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="name">Nombre <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                                        value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="price">Precio Normal <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="price" id="price" placeholder="Precio Normal"
                                            class="form-control" value="{{ old('price') }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="" class="form-control-label">Categorías <span class="text-danger">*</span></label></label>
                                    @include('ecommerce::admin.shared.categories', ['categories' => $categories,
                                    'selectedIds' =>
                                    []])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-6">

                        <div class="form-group">
                            <label for="cover" class="form-control-label">Cover <span class="text-danger">*</span></label></label>
                            <input type="file" name="cover" id="cover" class="form-control">
                        </div>
                        <div class="form-group relative">
                            <label for="image" class="form-control-label">Imagenes <span class="text-danger">*</span></label></label>
                            <input type="file" name="image[]" id="image" class="form-control" multiple>
                            <a class="text-center info-tooltip" data-toggle="tooltip"
                                data-original-title="Puedes usar (cmd o ctrl) para seleccionar multiples imagenes">
                                ! </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('admin.products.index') }}" class="btn btn-default btn-sm">Regresar</a>
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
            </div>
        </form>
    </div>
</section>
@endsection