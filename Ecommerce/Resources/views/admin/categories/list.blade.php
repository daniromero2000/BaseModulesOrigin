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
                            <li class="breadcrumb-item active" active aria-current="page">Categorías</li>
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
    @if($categories)
    <div class="card">
        <div class="card-header border-0">
            <h3 class="mb-0">Categorías</h3>
            @include('generals::layouts.search', ['route' => route('admin.permissions.index')])
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        <td class="text-center">Nombre</td>
                        <td class="text-center">Cover</td>
                        <td class="text-center">Estado</td>
                        <td class="text-center">Acciones</td>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($categories as $category)
                    <tr>
                        <td>
                            <a href="{{ route('admin.categories.show', $category->id) }}">{{ $category->name }}</a></td>
                        <td>
                            <a class="text-primary" data-toggle="modal" data-target="#cover{{$category->id}}"> Ver
                                cover</a>
                        </td>
                        <td>@include('generals::layouts.status', ['status' => $category->is_active])</td>
                        <td>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post"
                                class="form-horizontal">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <div class="btn-group">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                        class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                    <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                                        class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Borrar</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <div id="cover{{$category->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                @if(isset($category->cover))
                                <img src="{{ asset("storage/$category->cover") }}" alt="" class="img-responsive">
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            {{-- @include('generals::layouts.admin.pagination.pagination', [$skip]) --}}
        </div>
    </div>
    @else
    {{-- @include('generals::layouts.admin.pagination.pagination_null', [$skip]) --}}
    @endif
</section>
@endsection