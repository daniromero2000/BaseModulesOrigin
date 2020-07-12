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
                            <li class="breadcrumb-item active" active aria-current="page">Atributos</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
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
                            <li class="breadcrumb-item active" active aria-current="page">Editar Atributo</li>
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
        <form action="{{ route('admin.attributes.update', $attribute->id) }}" method="post" class="form">
            <div class="box-body">
                <div class="row">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nombre del Atributo <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Nombre " class="form-control"
                                value="{!! $attribute->name  !!}">
                        </div>
                    </div>
                    <div class="col-sm  -6">
                        <div class="form-group">
                            @include('ecommerce::admin.shared.status-select', ['status' =>
                            $attribute->is_active])
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.attributes.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection