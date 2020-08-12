@extends('layouts.front.app')
@section('styles')
<style>
    .nav-wrapper {
        padding: 1rem 0 !important;

        border-top-left-radius: .375rem !important;
        border-top-right-radius: .375rem !important;
    }

    .nav-pills .nav-link {
        border-radius: .375rem !important;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff !important;
        background-color: #ba3d6b !important;
    }

    .nav-pills .nav-item:not(:last-child) {
        padding-right: 1rem !important;
    }

    .shadow {
        box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15) !important;
    }

    .nav-pills .nav-link {
        font-size: .875rem !important;
        font-weight: 500 !important;

        padding: .75rem 1rem !important;

        transition: all .15s ease !important;

        color: #ba3d6b !important;
        background-color: #fff !important;
        box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08) !important;
    }

    .nav-pills .nav-link:hover {
        color: #d66c92 !important;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #ba3d6b;
    }

    @media (max-width: 575.98px) {
        .nav-pills .nav-item {
            margin-bottom: 1rem;
        }
    }

    @media (max-width: 767.98px) {
        .nav-pills:not(.nav-pills-circle) .nav-item {
            padding-right: 0;
        }
    }

    .nav-pills-circle .nav-link {
        line-height: 60px;

        width: 60px;
        height: 60px;
        padding: 0;

        text-align: center;

        border-radius: 50%;
    }

    .nav-pills-circle .nav-link-icon i,
    .nav-pills-circle .nav-link-icon svg {
        font-size: 1rem;
    }

    .nav-fill .nav-item {
        text-align: center;

        flex: 1 1 auto;
    }

    .flex-column {
        flex-direction: column !important;
    }

    .flex-column-reverse {
        flex-direction: column-reverse !important;
    }

    @media (min-width: 768px) {
        .flex-md-row {
            flex-direction: row !important;
        }
    }

    .nav-pills .nav-item:not(:last-child) {
        padding-right: 1rem;
    }

    .table {
        border-collapse: collapse !important;
    }

    .table td,
    .table th {
        background-color: #fff !important;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6 !important;
    }

    .table-dark {
        color: inherit;
    }

    .table-dark th,
    .table-dark td,
    .table-dark thead th,
    .table-dark tbody+tbody {
        border-color: #e9ecef;
    }

    .table .thead-dark th {
        color: inherit;
        border-color: #e9ecef;
    }
</style>

@endsection
@section('content')
<section class="container-reset content-empty content">
    <div class="row">
        <div class="card-body">
            @include('generals::layouts.errors-and-messages')
        </div>
        <div class="col-md-12">
            <h5 style=" color: gray; ">Mi Cuenta</h5>
            <hr>
        </div>
    </div>
    <div class="nav-wrapper">
        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Perfil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="orders-tab" data-toggle="tab" href="#orders" role="tab"
                    aria-controls="orders" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="address-tab" data-toggle="tab" href="#address" role="tab"
                    aria-controls="address" aria-selected="false"><i
                        class="ni ni-calendar-grid-58 mr-2"></i>Direcciones</a>
            </li>
        </ul>
    </div>
    <div class="card shadow mb-5">
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    {{$customer->name}} <br /><small>{{$customer->email}}</small>
                </div>
                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                    @if(!$orders->isEmpty())
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>Fecha</td>
                                    <td>Total</td>
                                    <td class="text-center">Estado</td>
                                </tr>
                            </tbody>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>
                                        <a data-toggle="modal" data-target="#order_modal_{{$order['id']}}"
                                            title="Show order"
                                            href="javascript: void(0)">{{ date('M d, Y h:i a', strtotime($order['created_at'])) }}</a>
                                        <div class="modal fade" id="order_modal_{{$order['id']}}" tabindex="-1"
                                            role="dialog" aria-labelledby="MyOrders">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Referencia
                                                            #{{$order['reference']}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {{-- <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span
                                                                aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Reference
                                                            #{{$order['reference']}}</h4>
                                                </div> --}}
                                                <div class="modal-body">
                                                    <table class="table text-sm">
                                                        <thead>
                                                            <th>Dirección</th>
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
                                                                    {{number_format($order['grand_total'],0)}}</td>
                                                                <td>
                                                                    <span class="badge"
                                                                        style="color: #ffffff; background-color: {{ $order['status']->color }}">{{ $order['status']->name }}</span>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <hr>
                                                    <p>Detalles del Pedido:</p>
                                                    <table class="table text-sm">
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
                                                                <td>{{number_format($product['price'],0)}}</td>
                                                                {{$product['id']}}
                                                                {{$product['cover']}}
                                                                <td><img src="{{ asset('storage/'.$product->cover) }}"
                                                                        width=50px height=50px
                                                                        alt="{{ $product['name'] }}"
                                                                        class="img-orderDetail">
                                                                </td>
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
                            ${{ number_format($order['grand_total'],0) }}</span></td>
                    <td class="text-center">
                        <span class="badge"
                            style="color: #ffffff; background-color: {{ $order['status']->color }}">{{ $order['status']->name }}</span>

                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                @else
                <p class="alert alert-warning">Sin pedidos aún. <a href="{{ route('home') }}">Compra Ahora!</a>
                </p>
                @endif
            </div>
            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                @if(!$addresses->isEmpty())
                <table class="table text-sm text-center">
                    <thead>
                        <th>Dirección</th>
                        <th>Ciudad</th>
                        <th>Zip</th>
                        <th>Opciones</th>
                    </thead>
                    <tbody>
                        @foreach($addresses as $address)
                        <tr>
                            <td>{{$address->customer_address}}</td>
                            <td>{{$address->city->city}}</td>
                            <td>{{$address->zip}}</td>
                            <td>
                                <form method="post"
                                    action="{{ route('customer.address.destroy', [auth()->user()->id, $address->id]) }}"
                                    class="form-horizontal">
                                    <a href="{{ route('customer.address.edit', [auth()->user()->id, $address->id]) }}"
                                        class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Editar</a>
                                    <input type="hidden" name="_method" value="delete">
                                    {{ csrf_field() }}

                                    <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                                        class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i>
                                        Borrar</button>
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

    {{-- <div class="row">
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
    <div role="tabpanel" class="tab-pane @if(request()->input('tab') == 'orders')active @endif" id="orders">
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
                        <a data-toggle="modal" data-target="#order_modal_{{$order['id']}}" title="Show order"
                            href="javascript: void(0)">{{ date('M d, Y h:i a', strtotime($order['created_at'])) }}</a>
                        <!-- Button trigger modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="order_modal_{{$order['id']}}" tabindex="-1" role="dialog"
                            aria-labelledby="MyOrders">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                                    <td><img src="{{ asset("storage/".$product['cover']) }}" width=50px
                                                            height=50px alt="{{ $product['name'] }}"
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
                        <p class="text-center" style="color: #ffffff; background-color: {{ $order['status']->color }}">
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
    <div role="tabpanel" class="tab-pane @if(request()->input('tab') == 'address')active @endif" id="address">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('customer.address.create', auth()->user()->id) }}" class="btn btn-primary">Crea tu
                    dirección</a>
            </div>
        </div>
        @if(!$addresses->isEmpty())
        <table class="table">
            <thead>
                <th>Dirección</th>
                <th>Ciudad</th>
                <th>Zip</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach($addresses as $address)
                <tr>
                    <td>{{$address->customer_address}}</td>
                    <td>{{$address->city->city}}</td>
                    <td>{{$address->zip}}</td>
                    <td>
                        <form method="post"
                            action="{{ route('customer.address.destroy', [auth()->user()->id, $address->id]) }}"
                            class="form-horizontal">
                            <div class="btn-group">
                                <input type="hidden" name="_method" value="delete">
                                {{ csrf_field() }}
                                <a href="{{ route('customer.address.edit', [auth()->user()->id, $address->id]) }}"
                                    class="btn btn-primary"> <i class="fa fa-pencil"></i> Editar</a>
                                <button onclick="return confirm('¿Estás Seguro?')" type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Borrar</button>
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
    </div> --}}
</section>
@endsection