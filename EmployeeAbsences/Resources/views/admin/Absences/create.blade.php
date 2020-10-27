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
                <li><a href="/admin/absences">Absences</a><span class="divider"></span>
                <li class="breadactive">Crear Permiso</li>
            </ol>
        </div>
    </div>
    
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25); width: 371px !important; border-radius: 13px !important;">
        <form action="/admin/absences/create" method="post" class="form" enctype="multipart/form-data">
            <div class="box-body">
                @csrf
                <h1>Crear Permiso </h1>
                    
                 <div id="cities" class="form-group ">
                    <label for="city_id">Fecha y Hora (Inicio y Finalización) </label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                      <input type="text" class="form-control float-right" id="reservationtime">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="name">Motivo <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-at"></i>
                        </div>
                        <select class="form-control select2bs4" style="width: 100%;">
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Justificación <span class="text-danger">*</span></label>
                    <div class="form-group">
                    <!-- <label for="customFile">Custom File</label> -->

                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile">
                      <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <label for="description">Comentario <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                         <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                </div>       

            <div class="box-footer">
                <div class="btn-group">
                    <a href="/admin/absences" class="btn btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </div>
        </form>
    </div>


</section>

@endsection