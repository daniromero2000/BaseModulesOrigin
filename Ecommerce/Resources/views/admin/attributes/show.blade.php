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
                            <li class="breadcrumb-item active" active aria-current="page">Atributo</li>
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
            <h2>Atributo {{ $attribute->name }}</h2>
            <div class=" text-right">
                <div class="btn-group">
                    <button data-toggle="modal" data-target="#create{{$attribute->id}}"
                        class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Agregar Valores</button>
                </div>
            </div>
        </div>
        <div class="card-body">

            @if(Empty(!$values))
            <table class="table align-items-center table-flush table-hover text-center">
                <thead class="thead-light ">
                    <tr>
                        <td>Valores de Atributo</td>
                        @if ($attribute->name == 'Color' )
                        <td>Color</td>
                        @endif
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($values as $item)
                    <tr>
                        <td>{{ $item->value }}</td>
                        @if ($attribute->name == 'Color' )
                        <td>{{ $item->description }}</td>
                        @endif
                        <td>
                            <div class="btn-group">
                                <button data-toggle="modal" data-target="#update{{$item->id}}"
                                    class="btn btn-primary btn-sm mr-2"><i class="fas fa-user-edit"></i></button>
                                <form
                                    action="{{ route('admin.attributes.values.destroy', [$attribute->id, $item->id]) }}"
                                    class="form-horizontal" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete">
                                    <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        Remover</button>
                                </form>

                                <div id="update{{$item->id}}" class="modal fade" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.attributesValues', $item->id) }}"
                                                method="post" enctype="multipart/form-data" class="form">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="put">
                                                        <div class="col-md-12 text-left">
                                                            <label class="form-control-label" for="value">Valor
                                                                de Atributo<span class="text-danger">*</span></label>
                                                            <input type="text" name="value" id="value"
                                                                placeholder="Valor Atributo" class="form-control"
                                                                value="{{ $item->value}}">
                                                            @if ($attribute->name == 'Color')
                                                            <label class="form-control-label mt-2"
                                                                for="description">Color<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="color" name="description" class="form-control"
                                                                value="{{ $item->description}}">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer text-right">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-sm">Actualizar</button>
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <div id="create{{$attribute->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.attributes.values.store', $attribute->id) }}" method="post"
                        class="form">
                        <div class="modal-body">
                            <div class="row">
                                {{ csrf_field() }}
                                <div class="col-md-12">
                                    <h3>Configura un valor para: <strong>{{ $attribute->name }}</strong></h3>
                                    <div>
                                        <label class="form-control-label" for="value">Valor de Atributo<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="value" id="value" placeholder="Valor Atributo"
                                            class="form-control" value="{!! old('value')  !!}">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            <a href="{{ route('admin.attributes.index') }}" class="btn btn-default btn-sm">Regresar</a>
        </div>
    </div>

</section>
@endsection