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
<section class="content">
    @include('generals::layouts.errors-and-messages')
    @if($category)
    <div class="box">
        <div class="box-body">
            <h2>Categoría</h2>
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
                        <td>{{ $category->description }}</td>
                        <td>
                            @if(isset($category->cover))
                            <img src="{{asset("storage/$category->cover")}}" alt="category image" class="img-thumbnail">
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if(!$categories->isEmpty())
        <hr>
        <div class="box-body">
            <h2>Sub Categories</h2>
            <table class="table">
                <thead>
                    <tr>
                        <td class="col-md-3">Nombre</td>
                        <td class="col-md-3">Descripción</td>
                        <td class="col-md-3">Cover</td>
                        <td class="col-md-3">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                    <tr>
                        <td><a href="{{route('admin.categories.show', $cat->id)}}">{{ $cat->name }}</a></td>
                        <td>{{ $cat->description }}</td>
                        <td>@if(isset($cat->cover))<img src="{{asset("storage/$cat->cover")}}" alt="category image"
                                class="img-thumbnail">@endif</td>
                        <td><a class="btn btn-primary" href="{{route('admin.categories.edit', $cat->id)}}"><i
                                    class="fa fa-edit"></i> Editar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        @if(!$products->isEmpty())
        <div class="box-body">
            <h2>Productos</h2>
            @include('ecommerce::admin.shared.products', ['products' => $products])
        </div>
        @endif
        <div class="box-footer">
            <div class="btn-group">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection