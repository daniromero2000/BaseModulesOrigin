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
                                <li class="breadcrumb-item active" active aria-current="page">Crear Banner</li>
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
        <form action="{{ route('admin.bannerManagement.store') }}" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    {{ csrf_field() }}
                    <h2 class="mb-3">Crear Banner</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nombre <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                                    value="{{ old('name') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="src">Banner</label>
                                <input type="file" name="src" id="src" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-control-label" for="alt">Descripción <small>(ALT)</small> </label>
                                <textarea class="form-control ckeditor" name="alt" id="alt" rows="2"
                                    placeholder="Descripción">{{ old('alt') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right pb-0">
                        <a href="{{ route('admin.bannerManagement.index') }}" class="btn btn-sm btn-default">Regresar</a>
                        <button type="submit" class="btn btn-sm btn-primary">Crear</button>
                    </div>
                </div>
        </form>

    </section>
@endsection
