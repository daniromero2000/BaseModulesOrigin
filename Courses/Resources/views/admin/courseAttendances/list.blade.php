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
                            <li class="breadcrumb-item active" active aria-current="page">Cursos</li>
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
    @if(!empty($coursesAttendances->toArray()))
    <div class="card">
        <div class="card-header border-0">
            <h3 class="mb-0">Asistencia a Cursos</h3>
            @include('generals::layouts.search', ['route' => route('admin.course_attendances.index')])
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover text-center">
                <thead class="thead-light ">
                    <tr>
                        <td>Curso</td>
                        <td>Cedula</td>
                        <td>Nombre Estudiante</td>
                        <td>Fecha</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coursesAttendances as $coursesAttendance)
                    <tr>
                        <td>{{ $coursesAttendance->course_name }}</td>
                        <td>{{ $coursesAttendance->identification }}</td>
                        <td>
                            {{ $coursesAttendance->name }} {{ $coursesAttendance->last_name }}
                        </td>
                        <td>{{ $coursesAttendance->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null', [$skip])
    @endif
</section>
@endsection
