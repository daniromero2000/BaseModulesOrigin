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
                            <li class="breadcrumb-item active" active aria-current="page">Ordenes</li>
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
    @if($checkouts)
    <div class="box">
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <h2>Checkouts sin finalizar</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="col-md-3">Fecha</td>
                                <td class="col-md-3">Cliente</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($checkouts as $checkout)
                            <tr>
                                <td><a title="Show checkout"
                                        href="{{ route('admin.checkouts.show', $checkout->id) }}">{{ date('M d, Y h:i a', strtotime($checkout->created_at)) }}</a>
                                </td>
                                <td>{{$checkout->customer->name}} {{$checkout->customer->last_name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection