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
                            <li class="breadcrumb-item active" active aria-current="page">Categorias de Modelos</li>
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
    @if(!$cammodelCategories->isEmpty())
    <div class="card">
        <div class="card-header border-0">
            <h2 class="mb-0">Categorias de Modelos</h2>
            @include('generals::layouts.search', ['route' => route('admin.cammodel-categories.index')])
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        @foreach ($headers as $header)
                        <th class="text-center">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="list text-center">
                    @if($cammodelCategories)
                    @foreach($cammodelCategories as $data)
                    <tr>
                        <td class="text-center">{{ $data->name }}</td>
                        <td class="text-center">{{ $data->slug }}</td>
                <td>@include('generals::layouts.status', ['status' => $data->is_active])</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{route('admin.cammodel-categories.edit', $data->id)}}"
                                    class=" table-action table-action" data-toggle="tooltip"
                                    data-original-title="Editar Categoria">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <a href="{{route('admin.cammodel-categories.show', $data->id)}}"
                                    class=" table-action table-action" data-toggle="tooltip"
                                    data-original-title="Ver Categoria">
                                    <i class="fas fa-search"></i>
                                </a>
                                <form id="form_1" action="{{route('admin.cammodel-categories.destroy', $data->id)}}" method="post"
                                    class="form-horizontal">
                                    <input type="hidden" name="_method" value="delete">
                                    @csrf
                                    <button type="submit" class="table-action table-action-delete button-reset"
                                        data-toggle="tooltip" data-original-title="Borrar Categoria">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null', [$skip, $optionsRoutes])
    @endif
</section>
@endsection