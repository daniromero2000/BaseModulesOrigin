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
                            <li class="breadcrumb-item active" active aria-current="page">Empleados</li>
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
    @if(!$leads->isEmpty())
    <div class="card">
        <div class="card-header border-0">
            <h3 class="mb-0">Empleados</h3>
            @include('generals::layouts.search', ['route' => route('admin.leads.index')])
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
                    @foreach ($leads as $data)
                    <tr>
                        <td> {{$data->identification_number}} </td>
                        <td> {{$data->name}} </td>
                        <td> {{$data->last_name}} </td>
                        <td> {{$data->email}} </td>
                        <td> {{$data->telephone}} </td>
                        <td> {{$data->department->name}} </td>
                        <td> {{$data->created_at}} </td>
                        <td> <span class="badge"
                                style="color:{{$data->leadStatuses->color}}; background:{{$data->leadStatuses->background}} ">{{$data->leadStatuses->status}}</span>
                        </td>
                        <td>
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('leads::admin.leads.layouts.modal_update')

                    @endforeach
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