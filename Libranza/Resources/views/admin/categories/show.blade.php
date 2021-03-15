@extends('generals::layouts.admin.app')
@section('styles')
<script src="{{ asset('js/ecommerce.js') }}" defer></script>
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
                            <li class="breadcrumb-item active" active aria-current="page">Categoría</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<section class="content" id="app">
    @include('generals::layouts.errors-and-messages')
    @if($category)
    <div class="card">
        <div class="card-body">
            <h2>Categoría</h2>
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.bannerManagement.index') }}" class="btn btn-default btn-sm">Regresar</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td class="col-md-4">Nombre</td>
                            <td class="col-md-4">Descripción</td>
                            <td class="col-md-4">Cover</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->alt }}</td>
                            <td>
                                @if(isset($category->src))
                                <img src="{{asset("storage/$category->src")}}" alt="category image"
                                    class="img-thumbnail">
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection