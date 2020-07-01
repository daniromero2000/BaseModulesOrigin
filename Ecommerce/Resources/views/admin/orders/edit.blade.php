@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="box">
        <div class="box-header">
            <div class="row">
                <div class="col-md-6">
                    <h2>
                        <a href="{{ route('admin.customers.show', $customer->id) }}">{{$customer->name}}</a> <br />
                        <small>{{$customer->email}}</small> <br />
                        <small>Referencia: <strong>{{$order->reference}}</strong></small>
                    </h2>
                </div>
                <div class="col-md-3 col-md-offset-3">
                    <h2><a href="{{route('admin.orders.invoice.generate', $order['id'])}}"
                            class="btn btn-primary btn-block">Download Invoice</a></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="box-body">
            <h4> <i class="fa fa-shopping-bag"></i> Información de la Orden</h4>
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
                        <td><a href="{{ route('admin.customers.show', $customer->id) }}">{{ $customer->name }}</a></td>
                        <td><strong>{{ $order['payment'] }}</strong></td>
                        <td>
                            <form action="{{ route('admin.orders.update', $order->id) }}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
                                <label for="order_status_id" class="hidden">Actualizar Estado</label>
                                <input type="text" name="total_paid" class="form-control" placeholder="Total paid"
                                    style="margin-bottom: 5px; display: none"
                                    value="{{ old('total_paid') ?? $order->total_paid }}" />
                                <div class="input-group">
                                    <select name="order_status_id" id="order_status_id" class="form-control select2">
                                        @foreach($statuses as $status)
                                        <option @if($currentStatus->id == $status->id) selected="selected" @endif
                                            value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn"><button onclick="return confirm('Are you sure?')"
                                            type="submit" class="btn btn-primary">Actualizar</button></span>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="bg-warning">Subtotal</td>
                        <td class="bg-warning">{{ $order['sub_total'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="bg-warning">Iva</td>
                        <td class="bg-warning">{{ $order['tax_amount'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="bg-warning">Descuento</td>
                        <td class="bg-warning">{{ $order['discounts'] }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="bg-success text-bold">Total de la Orden</td>
                        <td class="bg-success text-bold">{{ $order['grand_total'] }}</td>
                    </tr>
                    @if($order['total_paid'] != $order['grand_total'])
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="bg-danger text-bold">Total Pagado</td>
                        <td class="bg-danger text-bold">{{ $order['total_paid'] }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
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
                        <td>{{ $item->name }}</td>
                        <td>{!! $item->description !!}</td>
                        <td>{{ $item->pivot->quantity }}</td>
                        <td>{{ $item->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <h4> <i class="fa fa-truck"></i> Courier</h4>
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
                                    {{ $order->address->city }}
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
    <div class="box-footer">
        <div class="btn-group">
            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-default">Regresar</a>
        </div>
    </div>
    @endif
</section>
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
            let osElement = $('#order_status_id');
            osElement.change(function () {
                if (+$(this).val() === 1) {
                    $('input[name="total_paid"]').fadeIn();
                } else {
                    $('input[name="total_paid"]').fadeOut();
                }
            });
        })
</script>
@endsection