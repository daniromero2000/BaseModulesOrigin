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
                                <li class="breadcrumb-item active" active aria-current="page">Documentos</li>
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
            <div class="card-header border-0">
                <h3 class="mb-0">{{ $title }}</h3>
                @include('generals::admin.layouts.search.search', ['route' => route("$optionsRoutes.index")])
            </div>
            @if (!$documents->isEmpty())
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
                            @foreach ($documents as $data)
                                <tr class="text-center">
                                    <td> {{ $data->name }} </td>
                                    <td> @include('generals::layouts.status', ['status' => $data->is_active])</td>
                                    <td>
                                        @foreach ($data->categories as $item)
                                            {{ $item->name }} <br>
                                        @endforeach
                                    </td>
                                    <td> {{ $data->created_at }} </td>
                                    <td>
                                        @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                                        $optionsRoutes])
                                    </td>
                                </tr>
                                @include('generals::admin.layouts.modals.modal_update')
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-2">
                    @include('generals::layouts.admin.pagination.pagination', [$skip])
                </div>
            @else
                <div class="card-footer py-2">
                    @include('generals::layouts.admin.pagination.pagination_null', [$skip, $optionsRoutes])
                </div>
            @endif
        </div>
    </section>
@endsection
