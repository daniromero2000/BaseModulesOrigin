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
                            <li class="breadcrumb-item active" active aria-current="page">Crear Accion</li>
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
        <form action="{{ route('admin.actions.store') }}" method="post" class="form">
            <div class="card-body">
                @csrf
                <h2>Crear Accion</h2>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre <span
                                    class="text-danger">*</span></label>
                            <div class="input-group  mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-check"></i></span>
                                </div>
                                <input type="text" name="name" id="name" placeholder="Nombre" validation-pattern="name"
                                    class="form-control" value="{{ old('name') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="permission_id" class="form-control-label">Permiso</label>
                            <select class="form-control" name="permission_id" id="permission_id">
                                @foreach ($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->display_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="icon">Ícono <span
                                    class="text-danger">*</span></label>
                            <div class="input-group  mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-grip-horizontal"></i></span>
                                </div>
                                <input type="text" name="icon" id="icon" placeholder="Ícono" class="form-control"
                                    value="{{ old('icon') }}" required>
                            </div>
                        </div>
                    </div>

                     <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="principal">Es una accion principal? <span
                                    class="text-danger">*</span></label>
                             <select class="form-control" name="principal" id="principal">
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="icon">Ruta <span class="text-danger">*</span></label>
                            <div class="input-group  mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-grip-horizontal"></i></span>
                                </div>
                                <input type="text" name="route" id="route" placeholder="Ruta" class="form-control"
                                    value="{{ old('route') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <div class="btn-group">
                    <div class="btn-group">
                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-sm btn-default">Regresar</a>
                        <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


</section>

@endsection