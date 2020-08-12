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
                            <li class="breadcrumb-item active" active aria-current="page">Atributos</li>
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
        <div class="card-header d-flex justify-content-between">
            <h2>Atributos</h2>
            <div class="text-right">
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createAtributte"><i
                            class=" fa fa-plus"></i> Crear
                        Atributo</button>
                </div>
            </div>
        </div>
        <div class="card-body">

            @if(Empty(!$attributes))
            <table class="table align-items-center table-flush table-hover text-center">
                <thead class="thead-light ">
                    <tr>
                        <td>Nombre</td>
                        <td>Estado</td>
                        <td>Opciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attributes as $data)

                    @foreach($data->toArray() as $key => $value)
                    <tr>
                        <td class="text-center">
                            {{ $data[$key] }}
                        </td>
                        <td class="text-center">
                            @if($data->is_active == 1)
                            <button class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                            @else
                            <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                            @endif
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin..tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>

                    <div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Actualizar <b>{{$data->name}}</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.attributes.update', $data->id) }}" method="post"
                                    class="form">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body py-0">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="name">Nombre del Atributo <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="name" id="name" placeholder="Nombre "
                                                    class="form-control" value="{!! $data->name  !!}">
                                            </div>
                                        </div>
                                        <div class="col-sm  -6">
                                            <div class="form-group">
                                                @include('ecommerce::admin.shared.status-select', ['status' =>
                                                $data->is_active])
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
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="alert alert-warning">No hay atributos aún <a href="{{ route('admin.attributes.create') }}">Crear
                    uno</a></p>
            @endif
            <div id="createAtributte" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.attributes.store') }}" method="post" class="form">
                            <div class="modal-body">

                                <div class="row">
                                    {{ csrf_field() }}
                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-control-label" for="name">Nombre del Atributo<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name" id="name" placeholder="Nombre "
                                                class="form-control" value="{!! old('name')  !!}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
@endsection