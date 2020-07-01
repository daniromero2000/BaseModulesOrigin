@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <form action="{{ route('admin.brands.update', $brand->id) }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                        value="{{ $brand->name }}">
                </div>
            </div>
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection