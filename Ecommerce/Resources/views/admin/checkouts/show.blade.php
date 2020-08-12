@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <div class="box-body">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-6">
                        <h2>
                            <a href="{{ route('admin.customers.show', $customer->id) }}">{{$customer->name}}
                                {{$customer->last_name}}</a> <br />
                            <small>{{$customer->email}}</small> <br />
                        </h2>
                    </div>
                    <div class="box-footer">
                        <div class="btn-group">
                            <a href="{{ route('admin.checkouts.index') }}" class="btn btn-default">Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4> <i class="fa fa-shopping-bag"></i> Información de Checkout</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="col-md-3">Fecha</td>
                                <td class="col-md-3">Cliente</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ date('M d, Y h:i a', strtotime($checkout['created_at'])) }}</td>
                                <td><a href="{{ route('admin.customers.show', $customer->id) }}">{{ $customer->name }}
                                        {{ $customer->last_name }}</a>
                                </td>
                                <td><strong>{{ $checkout['payment'] }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        @if(!$items->isEmpty())
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <h4> <i class="fa fa-gift"></i> Items</h4>
                    <table class="table">
                        <thead>
                            <th class="col-md-2">SKU</th>
                            <th class="col-md-2">Nombre</th>
                            <th class="col-md-2">Cantidad</th>
                            <th class="col-md-2">Precio</th>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->name }} </td>

                                <td>{{ $item->pivot->quantity }}</td>
                                <td>{{ $item->price }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
