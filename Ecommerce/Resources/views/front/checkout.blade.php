@extends('generals::layouts.front.app')

@section('content')
<div class="container product-in-cart-list">
    @if(!$products->isEmpty())
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"> <i class="fa fa-home"></i> Home</a></li>
                <li class="active">Carrito de Compras</li>
            </ol>
        </div>
        <div class="col-md-12 content">
            <div class="box-body">
                @include('generals::layouts.errors-and-messages')
            </div>
            @if(count($addresses) > 0)
            <div class="row">
                <div class="col-md-12">
                    @include('ecommerce::front.products.product-list-table', compact('products'))
                </div>
            </div>
            @if(isset($addresses))
            <div class="row">
                <div class="col-md-12">
                    <legend><i class="fa fa-home"></i> Direcciones</legend>
                    <table class="table table-striped">
                        <thead>
                            <th>Alias</th>
                            <th>Dirección</th>
                            <th>Dirección de facturación</th>
                            <th>Dirección De entrega</th>
                        </thead>
                        <tbody>
                            @foreach($addresses as $key => $address)
                            <tr>
                                <td>{{ $address->alias }}</td>
                                <td>
                                    {{ $address->customer_address }} <br />
                                    @if(!is_null($address->province))
                                    {{ $address->city->city }} {{ $address->province->name }} <br />
                                    @endif
                                    {{ $address->city->city }} {{ $address->state_code }} <br>
                                    {{ $address->zip }}
                                </td>
                                <td>
                                    <label class="col-md-6 col-md-offset-3">
                                        <input type="radio" value="{{ $address->id }}" name="billing_address"
                                            @if($billingAddress->id == $address->id) checked="checked" @endif>
                                    </label>
                                </td>
                                <td>
                                    @if($billingAddress->id == $address->id)
                                    <label for="sameDeliveryAddress">
                                        <input type="checkbox" id="sameDeliveryAddress" checked="checked"> Same as
                                        billing
                                    </label>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody style="display: none" id="sameDeliveryAddressRow">
                            @foreach($addresses as $key => $address)
                            <tr>
                                <td>{{ $address->alias }}</td>
                                <td>
                                    {{ $address->customer_address }} <br />
                                    @if(!is_null($address->province))
                                    {{ $address->city->city }} {{ $address->province->name }} <br />
                                    @endif
                                    {{ $address->city->city }} {{ $address->state_code }} <br>
                                    {{ $address->zip }}
                                </td>
                                <td></td>
                                <td>
                                    <label class="col-md-6 col-md-offset-3">
                                        <input type="radio" value="{{ $address->id }}" name="delivery_address"
                                            @if(old('')==$address->id) checked="checked" @endif>
                                    </label>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @if(!is_null($rates))
            <div class="row">
                <div class="col-md-12">
                    <legend><i class="fa fa-truck"></i> Courier</legend>
                    <ul class="list-unstyled">
                        @foreach($rates as $rate)
                        <li class="col-md-4">
                            <label class="radio">
                                <input type="radio" name="rate" data-fee="{{ $rate->amount }}"
                                    value="{{ $rate->object_id }}">
                            </label>
                            <img src="{{ $rate->provider_image_75 }}" alt="courier" class="img-thumbnail" />
                            {{ $rate->currency }} {{ $rate->amount }}<br />
                            {{ $rate->servicelevel->name }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div> <br>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <legend><i class="fa fa-credit-card"></i> Pago</legend>
                    @if(isset($payments) && !empty($payments))
                    <table class="table table-striped">
                        <thead>
                            <th class="col-md-4">Nombre</th>
                            <th class="col-md-4">Descripción</th>
                            <th class="col-md-4 text-right">Elige pago</th>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            @include('ecommerce::layouts.front.payment-options', compact('payment', 'total',
                            'shipment_object_id'))
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="alert alert-danger">No se han configurado métodos de pago</p>
                    @endif
                </div>
            </div>
            @else
            <p class="alert alert-danger"><a href="{{ route('customer.address.create', [$customer->id]) }}">No se
                    encontraron direcciones.
                    Tienes que crear una dirección aqui.</a></p>
            @endif
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-warning">No hay productos en el carrito aún. <a href="{{ route('home') }}">Mostrar
                    ahora!</a></p>
        </div>
    </div>
    @endif
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    function setTotal(total, shippingCost) {
            let computed = +shippingCost + parseFloat(total);
            $('#total').html(computed.toFixed(2));
        }

        function setShippingFee(cost) {
            el = '#shippingFee';
            $(el).html(cost);
            $('#shippingFeeC').val(cost);
        }

        function setCourierDetails(courierId) {
            $('.courier_id').val(courierId);
        }

        $(document).ready(function () {

            let clicked = false;

            $('#sameDeliveryAddress').on('change', function () {
                clicked = !clicked;
                if (clicked) {
                    $('#sameDeliveryAddressRow').show();
                } else {
                    $('#sameDeliveryAddressRow').hide();
                }
            });

            let billingAddress = 'input[name="billing_address"]';
            $(billingAddress).on('change', function () {
                let chosenAddressId = $(this).val();
                $('.address_id').val(chosenAddressId);
                $('.delivery_address_id').val(chosenAddressId);
            });

            let deliveryAddress = 'input[name="delivery_address"]';
            $(deliveryAddress).on('change', function () {
                let chosenDeliveryAddressId = $(this).val();
                $('.delivery_address_id').val(chosenDeliveryAddressId);
            });

            let courier = 'input[name="courier"]';
            $(courier).on('change', function () {
                let shippingCost = $(this).data('cost');
                let total = $('#total').data('total');

                setCourierDetails($(this).val());
                setShippingFee(shippingCost);
                setTotal(total, shippingCost);
            });

            if ($(courier).is(':checked')) {
                let shippingCost = $(courier + ':checked').data('cost');
                let courierId = $(courier + ':checked').val();
                let total = $('#total').data('total');

                setShippingFee(shippingCost);
                setCourierDetails(courierId);
                setTotal(total, shippingCost);
            }
        });
</script>
@endsection