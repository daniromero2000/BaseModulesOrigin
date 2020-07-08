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
                            <small>Referencia: <strong>{{$order->reference}}</strong></small>
                        </h2>
                    </div>
                    <div class="col-md-3 col-md-offset-3">
                        <h2><a href="{{route('admin.orders.invoice.generate', $order['id'])}}"
                                class="btn btn-primary btn-block">Descargar Factura</a></h2>
                    </div>
                    <div class="box-footer">
                        <div class="btn-group">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-default">Regresar</a>
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-primary">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4> <i class="fa fa-shopping-bag"></i> Información de Orden</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="col-md-3">Fecha</td>
                                <td class="col-md-3">Cliente</td>
                                <td class="col-md-3">Pago</td>
                                <td class="col-md-3">Estado</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ date('M d, Y h:i a', strtotime($order['created_at'])) }}</td>
                                <td><a
                                        href="{{ route('admin.customers.show', $customer->id) }}">{{ $customer->name }} {{ $customer->last_name }}</a>
                                </td>
                                <td><strong>{{ $order['payment'] }}</strong></td>
                                <td><button type="button"
                                        class="btn btn-info btn-block">{{ $currentStatus->name }}</button>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Subtotal</td>
                                <td>{{ $order['sub_total'] }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Iva</td>
                                <td>{{ $order['tax_amount'] }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Descuento</td>
                                <td>{{ $order['discounts'] }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total de orden</td>
                                <td>{{ $order['grand_total'] }}</td>
                            </tr>
                            @if($order['total_paid'] != $order['grand_total'])
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Total Pagado</td>
                                <td>{{ $order['total_paid'] }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
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
                            <th class="col-md-2">Descripción</th>
                            <th class="col-md-2">Cantidad</th>
                            <th class="col-md-2">Precio</th>
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
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4> <i class="fa fa-map-marker"></i> Dirección</h4>
                            <table class="table">
                                <thead>
                                    <th>Dirección</th>
                                    <th>Ciudad</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->address->customer_address }}</td>
                                        <td>{{ $order->address->city->city }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4> <i class="fa fa-truck"></i> Envío</h4>
                            <table class="table">
                                <thead>
                                    <th class="col-md-3">Nombre</th>
                                    <th class="col-md-4">Descripción</th>
                                    <th class="col-md-5">Link</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->courier->name }}</td>
                                        <td>{{ $order->courier->description }}</td>
                                        <td>{{ $order->courier->url }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4> <i class="fa fa-map-marker"></i> Dirección</h4>
                            <table class="table">
                                <thead>
                                    <th>Dirección</th>
                                    <th>Ciudad</th>
                                    <th>Departamento</th>
                                    <th>Zip</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->address->address_1 }}</td>
                                        <td>
                                            @if(isset($order->address->city))
                                            {{ $order->address->city->city }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($order->address->province))
                                            {{ $order->address->province }}
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