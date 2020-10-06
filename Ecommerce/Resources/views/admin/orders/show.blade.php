@extends('generals::layouts.admin.app')
@section('styles')
<style>
    body {
        margin: 0;
        font-family: Open Sans, sans-serif;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #525f7f;
        text-align: left;
        background-color: #fff;
    }

    .h1,
    .h2,
    .h3,
    .h4,
    .h5,
    .h6,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin-bottom: .5rem;
        font-family: inherit;
        font-weight: 400;
        line-height: 1.5;
        color: #32325d;
    }

    .table thead th {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: .65rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: .0625rem solid #dee2e6;
    }

    .text-muted {
        color: #8898aa !important;
    }

    .small,
    small {
        font-size: 80%;
        font-weight: 400;
    }

    .table td,
    .table th {
        font-size: .8125rem;
        white-space: nowrap;
    }

    .table th {
        font-weight: 600;
    }

    .table td,
    .table th {
        padding: 1rem;
        vertical-align: top;
        border-top: .0625rem solid #dee2e6;
    }
</style>

@endsection
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
                            <span> Orden # FVNO-<strong>{{$order->id}}</strong></span>
                            <br>
                            Referencia:<span> <b>{{ $order->reference}}</b></span>
                            <br>
                            <span> Cliente: <a
                                    href="{{ route('admin.customers.show', $customer->id) }}"><strong>{{ ucfirst($customer->name) }}
                                        {{$customer->last_name}}</strong></span></a>
                            <br>
                            <span> Dirección: <strong>{{ $order->address->customer_address }}
                                    @if(isset($order->address->city))
                                    {{ $order->address->city->city }}
                                    @endif
                                    @if(isset($order->address->city))
                                    {{ $order->address->city->province->province }}
                                    @endif</strong>
                            </span>
                            <br>
                            Número Identificación: <span>
                                @if ($customer->customerIdentities->toArray())
                                <b>{{  $customer->customerIdentities[0]->identity_number}}</b>
                                @else
                                <b>NA</b>
                                @endif
                            </span>
                            <br>
                            Número Teléfono: <span> <b>{{ $customer->customerPhones[0]->phone}}</b></span>
                            <br>
                            Email: <span> <b>{{ $customer->customerEmails[0]->email}}</b></span>
                        </div>
                        <div class="d-flex align-items-center flex-wrap col-md-6 text-right mb-3 ml-auto">

                            <a href="{{route('admin.orders.invoice.generate', $order['id'])}}"
                                class="flex-fill btn btn-primary btn-sm ">Descargar Factura</a>
                            @if($currentStatus->id == 1)
                            @if(!$orderShipment->isEmpty() && $orderShipment[0]->company_id ==
                            $user->subsidiary->company_id )
                            <a href="{{route('admin.order-shipments.show', $orderShipment[0]['id'])}}"
                                class="flex-fill btn btn-primary btn-sm ">Ver Despacho </a>
                            @else
                            <!-- Generar Despacho Button -->
                            <button type="button" class="flex-fill btn btn-primary btn-sm " data-toggle="modal"
                                data-target="#staticBackdrop">Crear Despacho</button>
                            <!-- Generar Despacho Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1"
                                role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Crear Despacho</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {!! Form::open(['method' => 'POST','route' =>
                                            ['admin.order-shipments.store'],'style'=>'display:inline']) !!}
                                            {!! Form::hidden('order_id', $order['id']); !!}
                                            {!! Form::label('courier_id', 'Courier:', ['class' => 'control-label']) !!}
                                            {!! Form::select('courier_id', $couriers, $order['courier_id'],
                                            array('class' => 'form-control', 'multiple')) !!}
                                            <br>
                                            {!! Form::label('track_number', 'Numero de Guia:', ['class' =>
                                            'control-label']) !!}
                                            {!! Form::text('track_number', $order['tracking_number'], array('class' =>
                                            'form-control')); !!}
                                            {!! Form::hidden('total_qty', $cant); !!}
                                            {!! Form::hidden('total_weight', $weight); !!}
                                            <br>
                                            {!! Form::submit('Crear Despacho', ['class' => 'flex-fill btn btn-primary
                                            btn-sm']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endif


                            <a href="{{ route('admin.customers.show', $customer->id) }}"
                                class="flex-fill btn btn-primary btn-sm ">Ver cliente</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="w-100 p-3">
                    <h4> <i class="fa fa-shopping-bag"></i> Información de Orden</h4>
                </div>
                <div class="table-responsive">
                    <table class="table text-center table-flush table-hover">
                        <thead class="thead-light">
                            <tr>
                                <td>Fecha</td>
                                <td>Medio de pago</td>
                                <td>Estado</td>
                                <td>Valor</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ date('M d, Y h:i a', strtotime($order['created_at'])) }}</td>
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
        {{-- <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
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

    </div>
    </div> --}}
    </div>
    <div class="card">
        @if(!$order->orderPayments->isEmpty())
        <div class="card-body">
            <div class="card">
                <div class="w-100 p-3">
                    <h4> <i class="fa fa-gift"></i> Método de Pago</h4>
                </div>
                <div class="table-responsive">
                    <table class="table text-center table-flush table-hover">
                        <thead class="thead-light">
                            <th>Método de Pago</th>
                            <th>Descripción</th>
                            <th>Id de la transacción</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </thead>
                        <tbody>
                            @foreach($order->orderPayments as $payment)
                            <tr>
                                <td>{{ $payment->method }}</td>
                                <td>{{ $payment->description }} </td>
                                <td>{{ $payment->transaction_id }}</td>
                                <td>{{ $payment->state }}</td>
                                <td>{{ $payment->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endif
</section>
@endsection
{{-- @endif
</section>
@endsection--}}