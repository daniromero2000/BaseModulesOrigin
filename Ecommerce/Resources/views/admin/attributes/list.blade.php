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
        <div class="card-body">
            <h2>Atributos</h2>
            <div class="card-footer">
                <div class="btn-group">
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.attributes.create') }}"><i class="fa fa-plus"></i> Crear
                        Atributo</a>
                </div>
            </div>
            @if(Empty(!$attributes))
            @foreach($attributes as $data)
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
            @endforeach
            @else
            <p class="alert alert-warning">No hay atributos aún <a href="{{ route('admin.attributes.create') }}">Crear
                    uno</a></p>
            @endif
        </div>
    </div>
</section>
@endsection