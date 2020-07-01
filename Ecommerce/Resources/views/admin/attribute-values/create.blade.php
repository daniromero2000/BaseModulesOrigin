@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <form action="{{ route('admin.attributes.values.store', $attribute->id) }}" method="post" class="form">
            <div class="box-body">
                <div class="row">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <h2>Configura un valor para: <strong>{{ $attribute->name }}</strong></h2>
                        <div class="form-group">
                            <label for="value">Valor de Atributo<span class="text-danger">*</span></label>
                            <input type="text" name="value" id="value" placeholder="Attribute value"
                                class="form-control" value="{!! old('value')  !!}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.attributes.show', $attribute->id) }}"
                        class="btn btn-default btn-sm">Regresar</a>
                    <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection