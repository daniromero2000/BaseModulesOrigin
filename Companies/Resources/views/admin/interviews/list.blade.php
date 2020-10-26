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
                            <li class="breadcrumb-item active" active aria-current="page">Entrevistas</li>
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
    @if(!$interviews->isEmpty())
    <div class="card">
        <div class="card-header border-0">
            <h3 class="mb-0">Entrevistas</h3>
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
                    @if($interviews)
                    @foreach($interviews as $data)
                    <tr>
                        <td class="text-center">{{ $data->id }}</td>
                        <td class="text-center">{{ $data->name }} {{ $data->last_name }}</td>
                        <td class="text-center">{{ $data->email }}</td>
                        <td class="text-center">{{ $data->employeePosition->position }}</td>
                        <td class="text-center">
                            <span class="badge"
                                style="color: #ffffff; background-color: {{ $data->interviewStatus->color }}">
                                {{ $data->interviewStatus->name }}
                            </span>
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    <!-- Modal -->
                    {{-- @include('companies::layouts.edit_employee') --}}
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
