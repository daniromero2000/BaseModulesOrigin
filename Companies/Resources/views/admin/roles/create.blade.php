@extends('generals::layouts.admin.app')
@section('content')

<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"> <i class="fa fa-home"></i> Dashboard</a><span
                        class="divider"></span>
                </li>
                <li><a href="{{ route('admin.roles.index') }}">Roles</a><span class="divider"></span>
                <li class="breadactive">Crear Rol</li>
            </ol>
        </div>
    </div>
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('admin.roles.store') }}" method="post" class="form">
            <div class="box-body">
                @csrf
                <div class="form-group">
                    <label for="display_name">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-at"></i>
                        </div>
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

            <div class="box-footer">
                <div class="btn-group">
                    <div class="btn-group">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-default">Regresar</a>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


</section>

@endsection