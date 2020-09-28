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
    @if(!empty($orders))
    <div class="card">
        <div class="card-header">
            <h2>Ordenes {{ config('app.name') }}</h2>
            @include('generals::layouts.search', ['route' => route('admin.orders.index')])
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover text-center">
                <thead class="thead-light ">
                    <tr>
                        <td>Nº Orden</td>
                        <td>Fecha</td>
                        <td>Cliente</td>
                        <td>Courier</td>
                        <td>Total</td>
                        <td>Estado</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    {{-- @if ( $order->companyId == auth()->guard('employee')->user()->subsidiary->company_id) --}}
                    <tr>
                        <td>FVN0-{{$order->id}}</td>
                        <td><a title="Show order"
                                href="{{ route('admin.orders.show', $order->id) }}">{{ date('M d, Y h:i a', strtotime($order->created_at)) }}</a>
                        </td>
                        <td>{{$order->customer->name}} {{$order->customer->last_name}}</td>
                        <td>{{ $order->courier['name'] }}</td>
                        <td>
                            <span
                                class="label @if($order->grand_total != $order->total_paid) label-danger @else label-success @endif">{{ config('cart.currency') }}
                                ${{ number_format($order->grand_total, 0) }}</span>
                        </td>
                        <td>
                            <span class="badge"
                                style="color: #ffffff; background-color: {{ $order->orderStatus->color }}">
                                {{ $order->orderStatus->name }}
                            </span>

                        </td>
                    </tr>
                    {{-- @endif --}}
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null', [$skip])
    @endif
</section>
@endsection
