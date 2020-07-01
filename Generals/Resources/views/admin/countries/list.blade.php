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
            </ol>
        </div>
    </div>
    @if($countries)
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h1>{{$countries->count()}} Países</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center" scope="col-md-1">Nombre</th>
                        <th class="text-center" scope="col-md-1">ISO</th>
                        <th class="text-center" scope="col-md-1">ISO-3</th>
                        <th class="text-center" scope="col-md-1">Numcode</th>
                        <th class="text-center" scope="col-md-1">Phone Code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($countries as $country)
                    <tr>
                        <td class="text-center">
                            <a href="{{ route('admin.countries.show', $country->id) }}">{{ $country->name }}</a>
                        </td>
                        <td class="text-center">{{ $country->iso }}</td>
                        <td class="text-center">{{ $country->iso3 }}</td>
                        <td class="text-center">{{ $country->numcode }}</td>
                        <td class="text-center">{{ $country->phonecode }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</section>
@endsection