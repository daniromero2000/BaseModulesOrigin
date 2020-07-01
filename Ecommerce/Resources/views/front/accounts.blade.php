@extends('layouts.front.app')
@section('content')
<section class="container content">
    <div class="row">
        <div class="box-body">
            @include('generals::layouts.errors-and-messages')
        </div>
        <div class="col-md-12">
            <h2> <i class="fa fa-home"></i>Mi Cuenta</h2>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" @if(request()->input('tab') == 'profile') class="active" @endif><a
                            href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Perfil</a></li>
                    <li role="presentation" @if(request()->input('tab') == 'orders') class="active" @endif><a
                            href="#orders" aria-controls="orders" role="tab" data-toggle="tab">Pedidos</a></li>
                    <li role="presentation" @if(request()->input('tab') == 'address') class="active" @endif><a
                            href="#address" aria-controls="address" role="tab" data-toggle="tab">Direcciones</a></li>
                </ul>
                <div class="tab-content customer-order-list">
                    <div role="tabpanel" class="tab-pane @if(request()->input('tab') == 'profile')active @endif"
                        id="profile">
                        {{$customer->name}} <br /><small>{{$customer->email}}</small>
                    </div>
                    <div role="tabpanel" class="tab-pane @if(request()->input('tab') == 'orders')active @endif"
                        id="orders">
                        @if(!$orders->isEmpty())
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Fecha</td>
                                    <td>Total</td>
                                    <td>Estado</td>
                                </tr>
                            </tbody>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <a data-toggle="modal" data-target="#order_modal_{{$order['id']}}"
                                            title="Show order"
                                            href="javascript: void(0)">{{ date('M d, Y h:i a', strtotime($order['created_at'])) }}</a>
                                        <!-- Button trigger modal -->
                                        <!-- Modal -->
                                        <div class="modal fade" id="order_modal_{{$order['id']}}" tabindex="-1"
                                            role="dialog" aria-labelledby="MyOrders">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Reference
                                                            #{{$order['reference']}}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                                <th>Direccón</th>
                                                                <th>Metodo de Pago</th>
                                                                <th>Total</th>
                                                                <th>Estado</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <address>
                                                                            {{$order['address']->customer_address}}<br>
                                                                        </address>
                                                                    </td>
                                                                    <td>{{$order['payment']}}</td>
                                                                    <td>{{ config('cart.currency_symbol') }}
                                                                        {{$order['grand_total']}}</td>
                                                                    <td>
                                                                        <p class="text-center"
                                                                            style="color: #ffffff; background-color: {{ $order['status']->color }}">
                                                                            {{ $order['status']->name }}</p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <hr>
                                                        <p>Detalles del Pedido:</p>
                                                        <table class="table">
                                                            <thead>
                                                                <th>Nombre</th>
                                                                <th>Cantidad</th>
                                                                <th>Precio</th>
                                                                <th>Cover</th>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($order['products'] as $product)
                                                                <tr>
                                                                    <td>{{$product['name']}}</td>
                                                                    <td>{{$product['pivot']['quantity']}}</td>
                                                                    <td>{{$product['price']}}</td>
                                                                    <td><img src="{{ asset("storage/".$product['cover']) }}"
                                                                            width=50px height=50px
                                                                            alt="{{ $product['name'] }}"
                                                                            class="img-orderDetail"></td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span
                                            class="label @if($order['grand_total'] != $order['total_paid']) label-danger @else label-success @endif">{{ config('cart.currency') }}
                                            {{ $order['grand_total'] }}</span></td>
                                    <td>
                                        <p class="text-center"
                                            style="color: #ffffff; background-color: {{ $order['status']->color }}">
                                            {{ $order['status']->name }}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="alert alert-warning">Sin pedidos aún. <a href="{{ route('home') }}">Compra Ahora!</a>
                        </p>
                        @endif
                    </div>
                    <div role="tabpanel" class="tab-pane @if(request()->input('tab') == 'address')active @endif"
                        id="address">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('customer.address.create', auth()->user()->id) }}"
                                    class="btn btn-primary">Crea tu dirección</a>
                            </div>
                        </div>
                        @if(!$addresses->isEmpty())
                        <table class="table">
                            <thead>
                                <th>Dirección</th>
                                <th>Ciudad</th>
                                @if(isset($address->province))
                                <th>Departamento</th>
                                @endif
                                <th>State</th>
                                <th>Country</th>
                                <th>Zip</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach($addresses as $address)
                                <tr>
                                    <td>{{$address->customer_address}}</td>
                                    <td>{{$address->city}}</td>
                                    @if(isset($address->province))
                                    <td>{{$address->province->name}}</td>
                                    @endif
                                    <td>{{$address->state_code}}</td>
                                    <td>{{$address->zip}}</td>
                                    <td>{{$address->phone}}</td>
                                    <td>
                                        <form method="post"
                                            action="{{ route('customer.address.destroy', [auth()->user()->id, $address->id]) }}"
                                            class="form-horizontal">
                                            <div class="btn-group">
                                                <input type="hidden" name="_method" value="delete">
                                                {{ csrf_field() }}
                                                <a href="{{ route('customer.address.edit', [auth()->user()->id, $address->id]) }}"
                                                    class="btn btn-primary"> <i class="fa fa-pencil"></i> Editar</a>
                                                <button onclick="return confirm('Are you sure?')" type="submit"
                                                    class="btn btn-danger"> <i class="fa fa-trash"></i> Borrar</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <br />
                        <p class="alert alert-warning">No tienes direcciones creadas aún.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection