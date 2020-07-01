@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    @if(Empty(!$brands))
    <div class="box">
        <div class="box-body">
            <h2>Marcars</h2>
            <table class="table">
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                    <tr>
                        <td>
                            <a href="{{ route('admin.brands.show', $brand->id) }}">{{ $brand->name }}</a>
                        </td>
                        <td>
                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="post"
                                class="form-horizontal">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <div class="btn-group">
                                    <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                        class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a>
                                    <button onclick="return confirm('Are you sure?')" type="submit"
                                        class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Borrar</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <p class="alert alert-warning">Ninguna Marca Creada aún <a href="{{ route('admin.brands.create') }}">Crea una!</a>
    </p>
    @endif
</section>
@endsection