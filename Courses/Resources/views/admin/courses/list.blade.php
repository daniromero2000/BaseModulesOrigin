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
    @if(!empty($courses->toArray()))
    <div class="card">
        <div class="card-header border-0">
            <h3 class="mb-0">Cursos</h3>
            @include('generals::layouts.search', ['route' => route('admin.courses.index')])
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover text-center">
                <thead class="thead-light ">
                    <tr>
                        <td>#</td>
                        <td>Nombre</td>
                        <td>Estado</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                    <tr>
                        <td>
                            {{ $course->id }}
                        </td>
                        <td>
                            {{ $course->name }}
                        </td>
                        <td>@include('generals::layouts.status', ['status' => $course->is_active])</td>

                        <td class="table-actions">
                            <form action="{{ route('admin.courses.destroy', $course->id) }}" method="post" class="form-horizontal">
                                {{ csrf_field() }}
                                <a href="{{ route('admin.courses.edit', $course->id) }}" class="table-action table-action" data-toggle="tooltip" data-original-title="Editar">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <button onclick="return confirm('¿Estás Seguro?')" type="submit" class="table-action table-action-delete button-reset" data-toggle="tooltip" data-original-title="Borrar">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <input type="hidden" name="_method" value="delete">
                            </form>
                        </td>
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
