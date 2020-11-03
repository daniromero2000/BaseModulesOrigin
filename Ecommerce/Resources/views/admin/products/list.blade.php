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
                            <li class="breadcrumb-item active" active aria-current="page">Productos</li>
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
    @if(!empty($products))
    <div class="card">
        <div class="card-header border-0">
            <h3 class="mb-0">Productos</h3>
            <div class="ml-auto justify-content-end d-flex"
                style=" position: absolute; top: 22px; right: 22%; z-index: 99; ">
                <p>
                    <a data-toggle="modal" data-target="#modal-default"
                        class="btn btn-success btn-sm text-white">Actualizar
                        Inventario</a>
                </p>
            </div>
            <div class="ml-auto justify-content-end d-flex"
                style=" position: absolute; top: 22px; right: 9%; z-index: 99; ">
                <p>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.export.Products')}}" aria-expanded="false"
                        aria-controls="contentId">
                        Exportar Inventario
                    </a>
                </p>
            </div>
            @include('generals::layouts.search', ['route' => route('admin.products.index')])
        </div>
        @include('ecommerce::admin.shared.products')
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null', [$skip])
    @endif
    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
        aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.import.Products') }}" method="post" class="form"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Cargar Inventario</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="value">Cargar archivo<span class="text-danger">*</span></label>
                                    <input type="file" name="cover" id="cover" placeholder="Archivo Carga"
                                        class="form-control" value="{!! old('cover')  !!}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Cargar</button>
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection