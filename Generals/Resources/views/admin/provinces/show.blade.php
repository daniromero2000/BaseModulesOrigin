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
                <li><a href="{{ route('admin.countries.show', $countryId) }}">Departamentos</a><span class="divider"></span>
                <li class="breadactive">{{ $province->province }}</li>
            </ol>
        </div>
    </div>
    @if($province)
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h2>{{ $province->province }}</h2>
        </div>
        <div class="box-body">
            <h2>Ciudades / Municipios</h2>
            @include('generals::admin.shared.cities')
        </div>

        <div class="box-footer">
            <div class="btn-group">
                <a href="{{ route('admin.countries.show', $countryId) }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </div>
    </div>

    @endif

</section>

@endsection