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
    <div class="box">
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <h2>Atributo {{ $attribute->name }}</h2>
                    <div class="box-footer">
                        <div class="btn-group">
                            <a href="{{ route('admin.attributes.values.create', $attribute->id) }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-plus"></i> Agregar Valores</a>
                            <a href="{{ route('admin.attributes.index') }}" class="btn btn-default btn-sm">Regresar</a>
                        </div>
                    </div>
                    @if(Empty(!$values))
                    <table class="table table-striped" style="margin-left: 35px">
                        <thead>
                            <tr>
                                <td>Valores de Atributo</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($values as $item)
                            <tr>
                                <td>{{ $item->value }}</td>
                                <td>
                                    <form
                                        action="{{ route('admin.attributes.values.destroy', [$attribute->id, $item->id]) }}"
                                        class="form-horizontal" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                        <div class="btn-group">
                                            <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                                Remover</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
