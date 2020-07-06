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
                <li class="breadactive">Editar {{$role->display_name}}</li>
            </ol>
        </div>
    </div>
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('admin.roles.update', $role->id) }}" method="post" class="form">
            <div class="box-body">
                @csrf
                <input type="hidden" value="put" name="_method">
                <div class="form-group">
                    <label for="display_name">Nombre <span class="text text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-at"></i>
                        </div>
                        <input type="text" name="display_name" id="display_name" placeholder="Nombre"
                            validation-pattern="name" class="form-control" required
                            value="{{ old('display_name') ?: $role->display_name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Descripción <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" class="form-control" validation-pattern="text"
                        required placeholder="Descripción"> {!! old('description') ?: $role->description !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="permissions">Permisos <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-key"></i>
                        </div>
                        <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple">
                            @foreach($permissions as $permission)
                            <option @if(in_array($permission->id, $attachedPermissionsArrayIds)) selected="selected"
                                @endif value="{{ $permission->id }}">{{ $permission->display_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <div class="btn-group">
                    <div class="btn-group">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-default">Regresar</a>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


</section>

@endsection