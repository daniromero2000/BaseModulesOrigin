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
                            <li class="breadcrumb-item active" active aria-current="page">Editar Categoría</li>
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
        <form action="{{ route('admin.categories.update', $category->id) }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
                <input type="hidden" name="_method" value="put">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="parent">Categoria Padre</label>
                    <select name="parent" id="parent" class="form-control select2">
                        <option value="0">Sin padre</option>
                        @foreach($categories as $cat)
                        <option @if($cat->id == $category->parent_id) selected="selected" @endif
                            value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                        value="{!! $category->name ?: old('name')  !!}">
                </div>
                <div class="form-group">
                    <label for="description">Descripción </label>
                    <textarea class="form-control ckeditor" name="description" id="description" rows="5"
                        placeholder="Description">{!! $category->description ?: old('description')  !!}</textarea>
                </div>
                @if(isset($category->cover))
                <div class="form-group">
                    <img src="{{ asset("storage/$category->cover") }}" alt="" class="img-responsive"> <br />
                    <a onclick="return confirm('¿Estás Seguro?')"
                        href="{{ route('admin.category.remove.image', ['category' => $category->id]) }}"
                        class="btn btn-danger">Remover imagen?</a>
                </div>
                @endif
                <div class="form-group">
                    <label for="cover">Cover </label>
                    <input type="file" name="cover" id="cover" class="form-control">
                </div>
               <div class="col-sm  -6">
                    <div class="form-group">
                        @include('ecommerce::admin.shared.status-select', ['status' =>
                        $category->is_active])
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection