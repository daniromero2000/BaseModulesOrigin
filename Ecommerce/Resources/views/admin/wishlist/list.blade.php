<style>
.container-tr{
    background-color: #F8F9FE;
    color: #6D7AEB;
    font-weight: bold;
}
.icon-color{
    color: #6D7AEB;
}
.color-title-tab{
    color: #9A9A9A;
}
</style>

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
                            <li class="breadcrumb-item active" active aria-current="page">Lista de deseos</li>
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
    <div class="box">
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <div class="row px-3 py-3">
                        <h3 class="color-title-tab"> <i class="fas fa-list"></i> Lista de deseos por cliente</h3>
                    </div>
                    <table class="table">
                        <thead>
                            <tr class="text-center container-tr">
                                <td>Nombre de cliente</td>
                                <td>Producto deseado</td>
                                <td>Fecha de registro</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($wishlist as $data)
                            <tr>
                                <td>{{$data->customer->name}} {{$data->customer->last_name}} </td>
                                <td>{{$data->product->name}}</td>
                                <td>{{$data->created_at}}</td>
                                <!-- Button trigger modal -->
                                <td>
                                    <a data-toggle="modal" data-target="#covermodal" data-original-title="Ver cover" href="">
                                        <i class="fas fa-eye icon-color"></i>
                                    </a>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade" id="covermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="row w-100">
                                                    <div class="col-12 text-center">
                                                        <h2 style="color: #6D7AEB">Datos de registro deseo</h2>
                                                    </div>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row text-center">
                                                    <div class="col-12 col-md-12 col-sm-12">
                                                        <div class="row">
                                                            <div class="col-12 col-md-12">
                                                                <h4>Nombre de cliente</h4>
                                                                <p>{{$data->customer->name}} {{$data->customer->last_name}} </p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 col-md-12">
                                                                <h4>Nombre de producto</h4>
                                                                <p>{{$data->product->name}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 col-md-4">
                                                                <h4>Sku</h4>
                                                                <p>{{ $data->product->sku }}</p>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <h4>Precio</h4>
                                                                <p>$ {{ number_format($data->product->price)}}</p>
                                                            </div>
                                                            <div class="col-12 col-md-4">
                                                                <h4>Marca</h4>
                                                                <p>$ {{ number_format($data->product->price)}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <h4>Creación de deseo</h4>
                                                                <p>{{$data->created_at}}</p>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <h4>Movimiento a carro</h4>
                                                                <p>{{$data->moved_to_cart}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
</section>
@endsection
