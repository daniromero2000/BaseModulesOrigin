@extends('generals::layouts.admin.app')
@section('content')

<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"> <i class="fa fa-home"></i> Dashboard</a><span
                        class="divider"></span>
                </li>
                <li><a href="{{ route('admin.subsidiaries.index') }}">Sucursales</a><span class="divider"></span>
                <li class="breadactive">Crear Sucursal</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <form action="{{ route('admin.subsidiaries.store') }}" method="post" class="form" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Crear Sucursal</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="name" id="name" validation-pattern="name" placeholder="Nombre"
                                    class="form-control" value="{{ old('name') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="last_name">Dirección</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="address" id="address" placeholder="Dirección"
                                    validation-pattern="text" class="form-control" value="{{ old('address') }}"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="birthday">Teléfono</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" name="phone" id="phone" placeholder="Teléfono"
                                    validation-pattern="telephone" class="form-control" value="{{ old('phone') }}"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="cities" class="form-group">
                            <label class="form-control-label" for="city_id">Ciudad</label>
                            <div class="input-group">
                                <select name="city_id" id="city_id" class="form-control" enabled>
                                    @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="opening_hours">Horario Atenciòn</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-clock-o"></i></span>
                                </div>
                                <input type="text" name="opening_hours" id="address" placeholder="Horario"
                                    validation-pattern="text" class="form-control" value="{{ old('opening_hours') }}"
                                    required>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                <a href="{{ route('admin.subsidiaries.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </form>
    </div>


</section>

@endsection