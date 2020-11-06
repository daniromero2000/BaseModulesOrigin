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
                            <li class="breadcrumb-item active" active aria-current="page">Estudiantes</li>
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
    @if(!empty($students))
    <div class="card">
        <div class="card-header border-0">
            <h3 class="mb-0">Estudiantes</h3>
            @include('generals::layouts.search', ['route' => route('admin.students.index')])
        </div>
        <div class="ml-auto px-4 mr-2 py-2">
            <a data-toggle="modal" data-target="#modal-default" class="btn btn-success btn-sm text-white">Cargar
                archivo</a>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover text-center">
                <thead class="thead-light ">
                    <tr>
                        <td>#</td>
                        <td>Cédula</td>
                        <td>Nombres</td>
                        <td>Apellidos</td>
                        <td>Estado</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>
                            {{ $student->id }}
                        </td>
                        <td>
                            {{ $student->identification }}
                        </td>
                        <td>
                            {{ $student->name }}
                        </td>
                        <td>
                            {{ $student->last_name }}
                        </td>
                        <td>@include('generals::layouts.status', ['status' => $student->is_active])</td>
                        <td class="table-actions">
                            <form action="{{ route('admin.students.destroy', $student->id) }}" method="post"
                                class="form-horizontal">
                                {{ csrf_field() }}
                                <a href="{{ route('admin.students.edit', $student->id) }}"
                                    class="table-action table-action" data-toggle="tooltip"
                                    data-original-title="Editar">
                                    <i class="fas fa-user-edit"></i>
                                </a>
                                <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                                    class="table-action table-action-delete button-reset" data-toggle="tooltip"
                                    data-original-title="Borrar">
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

    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
        aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.students.store') }}" method="post" class="form"
                    enctype="multipart/form-data">

                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Cargar Estudiantes</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="value">Cargar archivo<span class="text-danger">*</span></label>
                                    <input type="file" name="cover" id="cover" placeholder="Archivo Carga"
                                        class="form-control" value="{!! old('cover')  !!}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Crear</button>
                        <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</section>
@endsection