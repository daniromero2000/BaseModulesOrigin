@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <form action="{{ route('admin.categories.store') }}" method="post" class="form" enctype="multipart/form-data">
            <div class="box-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="parent">Categoria Padre</label>
                    <select name="parent" id="parent" class="form-control select2">
                        <option value="">-- Seleccionar --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                        value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="description">Descripción </label>
                    <textarea class="form-control ckeditor" name="description" id="description" rows="5"
                        placeholder="Description">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="cover">Cover </label>
                    <input type="file" name="cover" id="cover" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Estado </label>
                    <select name="status" id="status" class="form-control">
                        <option value="0">Deshabilitado</option>
                        <option value="1">Habilitado</option>
                    </select>
                </div>
            </div>
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection