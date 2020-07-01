@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    @if($orders)
    <div class="box">
        <div class="box-body">
            <h2>Ordenes</h2>
            @include('generals::layouts.search', ['route' => route('admin.orders.index')])
            <table class="table">
                <thead>
                    <tr>
                        <td class="col-md-3">Fecha</td>
                        <td class="col-md-3">Cliente</td>
                        <td class="col-md-2">Courier</td>
                        <td class="col-md-2">Total</td>
                        <td class="col-md-2">Estado</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td><a title="Show order"
                                href="{{ route('admin.orders.show', $order->id) }}">{{ date('M d, Y h:i a', strtotime($order->created_at)) }}</a>
                        </td>
                        <td>{{$order->customer->name}}</td>
                        {{-- <td>{{ $order->courier->name }}</td> --}}
                        <td>
                            <span
                                class="label @if($order->grand_total != $order->total_paid) label-danger @else label-success @endif">{{ config('cart.currency') }}
                                {{ $order->grand_total }}</span>
                        </td>
                        <td>
                            <p class="text-center"
                                style="color: #ffffff; background-color: {{ $order->orderStatus->color }}">
                                {{ $order->orderStatus->name }}</p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</section>
@endsection