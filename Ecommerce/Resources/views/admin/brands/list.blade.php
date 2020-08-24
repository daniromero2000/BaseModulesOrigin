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
                            <li class="breadcrumb-item active" active aria-current="page">Marcas</li>
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
    @if(Empty(!$brands))
    <div class="box">
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <h2>Marcas</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Estado</td>
                                <td>Logo</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.brands.show', $brand->id) }}">{{ $brand->name }}</a>
                                </td>
                                <td>@include('generals::layouts.status', ['status' => $brand->is_active])</td>
                                <td>
                                    <a data-toggle="modal" data-target="#covermodal{{ $brand->id }}" data-original-title="Ver cover" href="">
                                            Ver Logo
                                        </a>
                                    </td>
                                <td>
                                    <form action="{{ route('admin.brands.destroy', $brand->id) }}" mehod="post"
                                        class="form-horizontal">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                            <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                                                class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
                                                Borrar</button>
                                        </div>
                                    </form>
                                </td>

                                <div class="modal fade" id="covermodal{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="row w-100">
                                                    <div class="col-12 text-center">
                                                        <h2>Imagen de cover {{ $brand->id }}</h2>
                                                    </div>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row text-center">
                                                    <div class="col-12 col-md-12 col-sm-12">
                                                        <img class="img-fluid" src="{{ asset('storage/'.$brand->logo) }}" alt="{{$brand->name}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button aria-describedby="Visualizar cover" style="color: #fff !important; background-color: #ba3d6b !important" type="button" class="btn" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <p class="alert alert-warning">Ninguna Marca Creada aún <a href="{{ route('admin.brands.create') }}">Crea una!</a>
    </p>
    @endif
</section>
@endsection
