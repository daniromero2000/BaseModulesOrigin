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
                            <li class="breadcrumb-item active" active aria-current="page">Crear Role</li>
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
        <form action="{{ route('admin.roles.store') }}" method="post" class="form">
            <div class="card-body">
                @csrf
                 <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" name="name" id="name" validation-pattern="name"
                            placeholder="Nombre" class="form-control" value="{{ old('display_name') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="display_name">Nombre a mostrar <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" name="display_name" id="display_name" validation-pattern="name"
                            placeholder="Nombre" class="form-control" value="{{ old('display_name') }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Descripción <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" class="form-control" validation-pattern="text"
                        required placeholder="Descripción">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="card-footer text-right">
                <div class="btn-group">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-default btn-sm">Regresar</a>
                        <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                </div>
            </div>
        </form>
    </div>


</section>

@endsection