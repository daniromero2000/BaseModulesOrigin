@extends('generals::layouts.admin.app')
@section('content')
    <section class="content">
        @include('generals::layouts.errors-and-messages')
        <div class="box">
            <form action="{{ route('admin.brands.store') }}" method="post" class="form" enctype="multipart/form-data">
                <div class="box-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="box-footer">
                    <div class="btn-group">
                        <a href="{{ route('admin.brands.index') }}" class="btn btn-default">Regresar</a>
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
