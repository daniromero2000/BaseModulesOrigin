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
                            <li class="breadcrumb-item active" active aria-current="page">Roles</li>
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
    @if(!$roles->isEmpty())
    <div class="card">
        <div class="card-header border-0">
            <h3 class="mb-0">Roles Empleados</h3>
            @include('generals::layouts.search', ['route' => route('admin.roles.index')])
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        @foreach ($headers as $header)
                        <th class="text-center" scope="col">{{ $header }} </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $data)
                    <tr>
                        @foreach($data->toArray() as $key => $value)
                        <td class="text-center">
                            {{ $data[$key] }}
                        </td>
                        @endforeach
                        <td class="text-center">
                            @include('generals::layouts.admin..tables.table_options', [$data, 'optionsRoutes' => $optionsRoutes])
                        </td>
                    </tr>
                    <div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Actualizar <b>{{$data->name}}</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.roles.update', $data->id) }}" method="post" class="form">

                                    @method('PUT')
                                    @csrf
                                    <div class="modal-body py-0">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="display_name{{ $data->id }}">Nombre</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-at"></i></span>
                                                        </div>
                                                        <input type="text" name="display_name"
                                                            id="display_name{{ $data->id }}" placeholder="Nombre"
                                                            validation-pattern="name" class="form-control" required
                                                            value="{{ old('display_name') ?: $data->display_name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="phone{{ $data->id }}">Permisos</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"> <i
                                                                    class="fa fa-key"></i></span>
                                                        </div>
                                                        <select name="permissions[]" id="permissions"
                                                            class="form-control select2" multiple="multiple">
                                                            @foreach($permissions as $permission)
                                                            <option @if(in_array($permission->id,
                                                                $attachedPermissionsArrayIds)) selected="selected"
                                                                @endif
                                                                value="{{ $permission->id }}">{{ $permission->display_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="address{{ $data->id }}">Descripción</label>
                                                    <div class="input-group input-group-merge">
                                                        <textarea name="description" id="description"
                                                            class="form-control" validation-pattern="text" required
                                                            placeholder="Descripción"> {!! old('description') ?: $data->description !!}</textarea>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                <tbody>
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