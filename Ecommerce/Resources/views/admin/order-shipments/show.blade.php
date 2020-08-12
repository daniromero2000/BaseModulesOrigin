@extends('generals::layouts.admin.app')
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4 w-100">
                <div class=" col-12">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Ordenes</a></li>
                            <li class="breadcrumb-item active" active aria-current="page">{{ ucfirst($customer->name) }}
                                {{$customer->last_name}}
                            </li>
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
    <div class="card">
        <div class="card-header">
            <div class="row w-100 mx-0 mt-3">
                <div class="col-12">
                    <div class="row mx-0 w-100">
                        <div class="col-6">
                            <span> Orden # <strong>{{$order->id}}</strong></span>
                            <br>
                            Referencia:<span> <b>{{ $order->reference}}</b></span>
                        </div>
                        <div class="col-md-6 text-right mb-3 ml-auto">
                            <a href="{{route('admin.orders.invoice.generate', $order['id'])}}"
                                class="btn btn-primary btn-sm">Descargar
                                Factura</a>

                            <a href="{{ route('admin.customers.show', $customer->id) }}"
                                class="btn btn-primary btn-sm">Ver cliente</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="w-100 p-3">
                    <h4> <i class="fa fa-shopping-bag"></i> Información de Orden</h4>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center text-center table-flush table-hover text-center">
                        <thead class="thead-light ">
                            <tr>
                                <td>Fecha</td>
                                <td>Cliente</td>
                                <td>Pago</td>
                                <td>Estado</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ date('M d, Y h:i a', strtotime($order['created_at'])) }}</td>
                                <td><a href="{{ route('admin.customers.show', $customer->id) }}">{{ $customer->name }}
                                        {{ $customer->last_name }}</a>
                                </td>
                                <td><strong>{{ $order['payment'] }}</strong></td>
                                <td><span class="badge bg-info text-white">{{ $currentStatus->name }}</span>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Subtotal</td>
                                <td>${{ number_format($order['sub_total'], 0) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Impuesto</td>
                                <td>${{ number_format($order['tax_amount'], 0) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Descuento</td>
                                <td>${{ number_format($order['discounts'],0) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Envío</td>
                                <td>${{ number_format($order['total_shipping'], 0) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total de orden</td>
                                <td>${{ number_format($order['grand_total'], 0) }}</td>
                            </tr>
                            @if($order['total_paid'] != $order['grand_total'])
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total Pagado</td>
                                <td>${{ number_format($order['total_paid'], 0) }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <div class="btn-group">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-default btn-sm">Regresar</a>
                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-primary btn-sm">Editar</a>
            </div>
        </div>
    </div>
    @if($order)
    @if($order->grand_total != $order->total_paid)
    <p class="alert alert-danger">
        Ooops, hay una discrepancia en el monto total de la orden y el monto pagado <br />
        Monto Total de orden: <strong>{{ config('cart.currency') }} {{ $order->grand_total }}</strong> <br>
        Monto Total Pagado <strong>{{ config('cart.currency') }} {{ $order->total_paid }}</strong>
    </p>
    @endif
    <div class="card">
        @if(!$items->isEmpty())
        <div class="card-body">
            <div class="card">
                <div class="w-100 p-3">
                    <h4> <i class="fa fa-gift"></i> Items</h4>
                </div>
                <div class="table-responsive">
                    <table class="table text-center table-flush table-hover">
                        <thead class="thead-light">
                            <th>SKU</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->name }} </td>
                                <td>
                                    {!! $item->description !!}
                                    @php($pattr =
                                    \Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute::find($item->product_attribute_id))
                                    @if(!is_null($pattr))<br>
                                    @foreach($pattr->attributesValues as $it)
                                    <p class="label label-primary">{{ $it->attribute->name }} : {{ $it->value }}</p>
                                    @endforeach
                                    @endif
                                </td>
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
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="w-100 p-3">
                            <h4> <i class="fa fa-truck"></i> Envío</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center text-center table-flush table-hover">
                                <thead class="thead-light">
                                    <th>Nombre</th>
                                    <th>Descripción</th>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->courier->name }}</td>
                                        <td>{{ $order->courier->description }}</td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="w-100 p-3">
                            <h4> <i class="fa fa-map-marker"></i> Dirección</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center text-center table-flush table-hover">
                                <thead class="thead-light">
                                    <th>Dirección</th>
                                    <th>Ciudad</th>
                                    <th>Departamento</th>
                                    <th>Zip</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->address->customer_address }}</td>
                                        <td>
                                            @if(isset($order->address->city))
                                            {{ $order->address->city->city }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($order->address->city))
                                            {{ $order->address->city->province->province }}
                                            @endif
                                        </td>
                                        <td>{{ $order->address->zip }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection