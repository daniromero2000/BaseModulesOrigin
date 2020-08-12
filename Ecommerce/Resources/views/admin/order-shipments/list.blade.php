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
    @if($shipments)

    <div class="card">
        <div class="card-header">
            <h2>Order Shipments</h2>
            @include('generals::layouts.search', ['route' => route('admin.orders.index')])
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover text-center">
                <thead class="thead-light ">
                    <tr>
                        <td>Orden</td>
                        <td>Courier</td>
                        <td>Cantidad</td>
                        <td>Peso</td>
                        <td>Track #</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipments as $item)
                    <tr>
                        <td>{{ $item->order_id }} </td>
                        <td>{{ $item->courier->name }}</td>
                        <td>{{ $item->total_qty }}</td>
                        <td>{{ $item->total_weight }}</td>
                        <td>{{ $item->track_number }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @endif
</section>
@endsection
