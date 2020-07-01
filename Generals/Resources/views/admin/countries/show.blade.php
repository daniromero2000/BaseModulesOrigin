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
                <li><a href="{{ route('admin.countries.index') }}">Países</a><span class="divider"></span>
                <li class="breadactive">{{ $country->name }}</li>
            </ol>
        </div>
    </div>
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h2>{{ $country->name }}</h2>
            <table class="table">
                <tbody>
                    <tr>
                        <th class="text-center" scope="col-md-2">ISO</th>
                        <th class="text-center" scope="col-md-2">ISO-3</th>
                        <th class="text-center" scope="col-md-2">Numcode</th>
                        <th class="text-center" scope="col-md-2">Phone Code</th>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td class="text-center">{{ $country->iso }}</td>
                        <td class="text-center">{{ $country->iso3 }}</td>
                        <td class="text-center">{{ $country->numcode }}</td>
                        <td class="text-center">{{ $country->phonecode }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="box crud-box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h2>Departamentos</h2>
            @include('generals::admin.shared.provinces', ['country' => $country->id])
        </div>

        <div class="box-footer">
            <div class="btn-group">
                <a href="{{ route('admin.countries.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </div>
    </div>

</section>

@endsection