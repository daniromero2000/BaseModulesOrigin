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
                            <li class="breadcrumb-item active" active aria-current="page">Modelos</li>
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
    @if(!$cammodels->isEmpty())
    <div class="card">
        <div class="card-header border-0">
            <h2 class="mb-0">Modelos</h2>
            @include('generals::layouts.search', ['route' => route('admin.cammodels.index')])
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
                <tbody class="list">
                    @if($cammodels)
                    @foreach($cammodels as $data)
                    <tr>
                        <td class="text-center">{{ $data->id }}</td>
                        <td class="text-center">{{ $data->nickname }}</td>
                        <td class="text-center">{{ $data->fake_age }}</td>
                        <td class="text-center">{{ $data->meta }}</td>
                        <td class="text-center">{{ $data->manager->name }}</td>
                        {{-- <td class="text-center">
                                        @include('generals::layouts.status', ['status' => $data->is_active])</td> --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{route('admin.cammodels.show', $data->id)}}"
                                    class=" table-action table-action" data-toggle="tooltip"
                                    data-original-title="Editar Empleado">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <form id="form_1" action="{{route('admin.cammodels.destroy', $data->id)}}" method="post"
                                    class="form-horizontal">
                                    <input type="hidden" name="_token" value="QI4X4MJLEAJOe0hYTsfQ4pJ5Clt3UAte7ZupvkKL">
                                    <button type="submit" class="table-action table-action-delete button-reset"
                                        data-toggle="tooltip" data-original-title="Borrar Modelo">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <input type="hidden" name="_method" value="delete">
                                </form>
                            </div>
                            {{-- @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' => $optionsRoutes]) --}}
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