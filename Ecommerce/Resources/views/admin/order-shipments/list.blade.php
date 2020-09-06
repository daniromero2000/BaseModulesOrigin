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
                            <li class="breadcrumb-item active" active aria-current="page"><a href="{{ route('admin.order-shipments.index') }}">Despachos</a></li></li>
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
            <h2>Despacho de Ordenes</h2>
            @include('generals::layouts.search', ['route' => route('admin.order-shipments.index')])
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <td>Orden</td>
                        <td>Courier</td>
                        <td>Cantidad</td>
                        <td>Peso</td>
                        <td>Track #</td>
                        <td>Despacho</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shipments as $item)
                        @if ( $item->company_id == $company_id)
                            <tr>
                                <td><a title="Show order"
                                    href="{{ route('admin.orders.show', $item->order_id) }}">{{ $item->order_id }}</a> </td>
                                <td>{{ $item->courier->name }}</td>
                                <td>{{ $item->total_qty }}</td>
                                <td>{{ $item->total_weight }}</td>
                                <td>{{ $item->track_number }}</td>
                                <td>
                                    <a title="Ver Despacho"  href="{{route('admin.order-shipments.show', $item->id)}}"><i class="fa fa-truck"></i></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    </div>

    @endif
</section>
@endsection
