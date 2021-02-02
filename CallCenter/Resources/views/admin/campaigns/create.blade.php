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
                                <li class="breadcrumb-item active" active aria-current="page">Crear Solicitud</li>
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
            <form action="{{ route('admin.campaigns.store') }}" method="post"  enctype="multipart/form-data" class="form">
                <div class="card-body">
                    @csrf
                    <h2>Crear Campaña</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nombre de la campaña<span
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
                                <label class="form-control-label" for="script">Guion <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="script_id" id="script_id">
                                    <option value=""> Selecciona</option>
                                    @foreach ($scripts as $script)
                                        <option value="{{ $script->id }}">{{ $script->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                                 <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="script">Questionario<span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="questionnary_id" id="questionnary_id">
                                    <option value=""> Selecciona</option>
                                    <option value="0"> No aplica</option>
                                    @foreach ($questionnaires as $questionnaire)
                                        <option value="{{ $questionnaire->id }}">{{ $questionnaire->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="script">Departamento<span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="department_id" id="department_id">
                                    <option value=""> Selecciona</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Fecha de inicio<span
                                        class="text-danger">*</span></label>
                                <div class="input-group  mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-check"></i></span>
                                    </div>
                                    <input type="date" name="begindate" id="begindate" class="form-control" value="{{ old('begindate') }}" required>
                                </div>
                            </div>
                        </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Fecha de finalización<span
                                        class="text-danger">*</span></label>
                                <div class="input-group  mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-check"></i></span>
                                    </div>
                                    <input type="date" name="endingdate" id="endingdate" class="form-control" value="{{ old('endingdate') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="description">Descripción <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="btn-group">
                        <div class="btn-group">
                            <a href="{{ route('admin.campaigns.index') }}" class="btn btn-sm btn-default">Regresar</a>
                            <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
