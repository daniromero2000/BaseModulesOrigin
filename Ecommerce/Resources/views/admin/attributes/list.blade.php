@extends('generals::layouts.admin.app')

@section('content')

<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-body">
            <h2>Atributos</h2>
            @if(Empty(!$attributes))
            <table class="table">
                <thead>
                    <tr>
                        <td>Nombre del Atributo/td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attributes as $attribute)
                    <tr>
                        <td>
                            <a href="{{ route('admin.attributes.show', $attribute->id) }}">{{ $attribute->name }}
                                <strong>({{ $attribute->values->count() }})</strong></a>
                        </td>
                        <td>
                            <form action="{{ route('admin.attributes.destroy', $attribute->id) }}" method="post"
                                class="form-horizontal">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete">
                                <div class="btn-group">
                                    <a href="{{ route('admin.attributes.values.create', $attribute->id) }}"
                                        class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Add values</a>
                                    <a href="{{ route('admin.attributes.edit', $attribute->id) }}"
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
            <div class="card-footer">
                <div class="btn-group">
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.attributes.create') }}"><i
                            class="fa fa-plus"></i> Crear Atributo</a>
                </div>
            </div>
            @else
            <p class="alert alert-warning">No hay atributos aún <a href="{{ route('admin.attributes.create') }}">Crear
                    uno</a></p>
            @endif
        </div>
    </div>
</section>
@endsection