@extends('layouts.admin.app')
@section('content')

<section class="content">
    @include('layouts.errors-and-messages')
    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"> <i class="fa fa-home"></i> Dashboard</a><span
                        class="divider"></span>
                </li>
                <li><a href="{{ route('admin.subsidiaries.index') }}">Sucursales</a><span class="divider"></span>
                <li class="breadactive">Editar {{$subsidiary->name}}</li>
            </ol>
        </div>
    </div>
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <form action="{{ route('admin.subsidiaries.update', $subsidiary->id) }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
                @method('PUT')
                @csrf
                <h1>Editar Sucursal</h1>
                <div class="form-group">
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-at"></i>
                        </div>
                        <input type="text" name="name" id="name" placeholder="Nombre" validation-pattern="text"
                            class="form-control" value="{!! $subsidiary->name ?: old('name')  !!}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Dirección <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <input type="text" name="address" id="address" placeholder="Dirección" validation-pattern="text"
                            class="form-control" value="{!! $subsidiary->address ?: old('address')  !!}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Teléfono <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" name="phone" id="phone" placeholder="Teléfono" validation-pattern="telephone"
                            class="form-control" value="{!! $subsidiary->phone ?: old('phone')  !!}" required>
                    </div>
                </div>

                <div id="cities" class="form-group">
                    <label for="city_id">Ciudad </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <select name="city_id" id="city_id" class="form-control">
                            @foreach($cities as $city)
                            @if($city->id == $cityId)
                            <option selected="selected" value="{{ $city->id }}">{{ $city->city }}</option>
                            @else
                            <option value="{{ $city->id }}">{{ $city->city }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="opening_hours">Horario Atenciòn <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <input type="text" name="opening_hours" id="address" placeholder="Horario"
                            validation-pattern="text" class="form-control"
                            value="{!! $subsidiary->opening_hours ?: old('opening_hours')  !!}" required>
                    </div>
                </div>

            </div>

            <div class="box-footer">
                <div class="btn-group">
                    <a href="{{ route('admin.subsidiaries.index') }}" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>


</section>

@endsection