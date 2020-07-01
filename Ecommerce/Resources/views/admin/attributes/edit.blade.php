@extends('generals::layouts.admin.app')

@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <form action="{{ route('admin.attributes.update', $attribute->id) }}" method="post" class="form">
            <div class="box-body">
                <div class="row">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="put">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name">Nombre del Atributo <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Attribute name" class="form-control"
                                value="{!! $attribute->name  !!}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.attributes.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualzar</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection