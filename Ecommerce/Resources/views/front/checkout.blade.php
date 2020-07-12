@extends('layouts.front.app')

@section('content')
<div class="container-reset content-empty mb-2">
    @if(!$products->isEmpty())
    <div class="row mx-0">
        <div class="col-12 mb-2">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"> <i class="fa fa-home"></i> Home</a></li>
                <li class="active">Carrito de Compras</li>
            </ol>
        </div>
        <div class="col-12 mb-2 content">
            <div class="box-body">
                @include('generals::layouts.errors-and-messages')
            </div>
        </div>

        <div class="col-7 my-2 p-0 p-sm-3">
            @if(isset($addresses))
            <div class="w-100">
                <div class="card">
                    <div class="card-body">
                        <div class="w-100 d-flex justify-content-between">
                            <div class="my-auto">
                                <h6>Direcciones</h6>
                            </div>
                            <div class="my-auto">
                                <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">Agregar</button>
                            </div>
                        </div>
                        <table class="table table-striped mt-3">
                            <thead>
                                <th>Alias</th>
                                <th>Dirección</th>
                                <th>Dirección de facturación</th>
                                <th>Dirección de entrega</th>
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
                                                @if($billingAddress->id ==
                                            $address->id) checked="checked" @endif>
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
                                                @if(old('')==$address->id)
                                            checked="checked" @endif>
                                        </label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            @endif
            @if(!is_null($rates))
            <div class="w-100">
                <div class="card">
                    <div class="card-body">
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
                </div>

            </div>
            @endif
            <div class="w-100">
                <div class="card">
                    <div class="card-body">
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

            </div>
        </div>
        <div class="col-md-5 my-2 p-0 p-sm-3 order-md-last">
            <div class="card" id="register">
            </div>
        </div>

    </div>
    @else
    <div class="row">
        <div class="col-12 mb-2">
            <p class="alert alert-warning">No hay productos en el carrito aún. <a href="{{ route('home') }}">Mostrar
                    ahora!</a></p>
        </div>
    </div>
    @endif
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar direccion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('customer.address.store', $customer->id) }}" method="post" class="form"
                enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="default_address" value="1">
                    <div class="card-body p-2">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="alias">Alias <span class="text-danger">*</span></label>
                            <input type="text" name="alias" id="alias" placeholder="Casa u Oficina" class="form-control"
                                value="{{ old('alias') }}">
                        </div>
                        <div class="form-group">
                            <label for="customer_address">Dirección <span class="text-danger">*</span></label>
                            <input type="text" name="customer_address" id="customer_address" placeholder="Dirección"
                                class="form-control" value="{{ old('customer_address') }}">
                        </div>
                        <div class="form-group">
                            <label for="country_id">País </label>
                            <select name="country_id" id="country_id" class="form-control select2">
                                <option value="">Selecciona</option>
                                @foreach($countries as $country)
                                <option @if(env('SHOP_COUNTRY_ID')==$country->id) selected="selected" @endif
                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="provinces" class="form-group" style="display: none;"></div>
                        <div id="cities" class="form-group" style="display: none;"></div>
                        <div class="form-group">
                            <label for="phone">Tu Teléfono </label>
                            <input type="text" name="phone" id="phone" placeholder="Phone number" class="form-control"
                                value="{{ old('phone') }}">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                    <button type="submmit" class="btn btn-primary btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    function cart() {
    $.get('/api/getCart/', function (data) {
        var cart = '';
        data.cartItems.forEach(e => {
            cart += '<div class="px-4 pt-4">Resumen de la compra</div><div class="card-body"><a href="/cart" class="dropdown-item"> <div class="media"> <img src="' + e.cover + '" alt="' + e.slug + '" class="img-size-50 mr-3 img-circle"> <div class="media-body"> <h3 class="dropdown-item-title"> ' + e.name + ' </h3> <p class="text-sm"></p> <p class="text-sm text-muted"><i class="fas fa-dollar-sign"></i> ' + e.price + ' x ' + e.qty + '</p> </div> </div>  </a> <div class="dropdown-divider"></div></div>'
        });
             
        const formatter = new Intl.NumberFormat('es-CO', {
            style: 'currency',
            currency: 'COP',
            minimumFractionDigits: 0
        })
        data.subtotal = formatter.format(data.subtotal);

        cart = cart != '' ? cart += '<div class=""> <div class="media"> <div class="media-body d-flex justify-content-between px-4 py-2"> <p class="text-sm subtotal">Subtotal</p> <p class="text-sm text-muted price">' + data.subtotal + '</p> </div> </div>  </div> <div class="dropdown-divider"></div>' : '<a href="#" class="dropdown-item dropdown-footer">Tu carrito esta vacío </a> <div class="dropdown-item dropdown-footer"> <div class="px-3"> <a href="/cart" class="btn button-reset d-block">Ir al carrito</a> </div> </div>';

        $('#register').html(cart);
    });
 }
 cart();
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
<script type="text/javascript">
    function findProvinceOrState(countryId) {
            $.ajax({
                url : '/api/v1/country/' + countryId + '/province',
                success: function (res) {
                    if (res.data.length > 0) {
                        let html = '<label for="province_id">Provinces </label>';
                        html += '<select name="province_id" id="province_id"  class="form-control select2">';
                        $(res.data).each(function (idx, v) {
                            html += '<option value="'+ v.id+'">'+ v.name +'</option>';
                        });
                        html += '</select>';

                        $('#provinces').html(html).show();
                        $('.select2').select2();

                        findCity(countryId, 1);

                        $('#province_id').change(function () {
                            var provinceId = $(this).val();
                            findCity(countryId, provinceId);
                        });
                    } else {
                        $('#provinces').hide().html('');
                        $('#cities').hide().html('');
                    }
                }
            });
        }

        function findCity(countryId, provinceOrStateId) {
            $.ajax({
                url: '/api/v1/country/' + countryId + '/province/' + provinceOrStateId + '/city',
                contentType: 'json',
                success: function (data) {
                    let html = '<label for="city_id">City </label>';
                    html += '<select name="city_id" id="city_id"  class="form-control select2">';
                    $(data.data).each(function (idx, v) {
                        html += '<option value="'+ v.id+'">'+ v.name +'</option>';
                    });
                    html += '</select>';

                    $('#cities').html(html).show();
                    $('.select2').select2();
                },
                errors: function (data) {
                    console.log(data);
                }
            });
        }
        function findUsStates() {
            $.ajax({
                url : '/country/' + countryId + '/state',
                contentType: 'json',
                success: function (res) {
                    if (res.data.length > 0) {
                        let html = '<label for="state_code">States </label>';
                        html += '<select name="state_code" id="state_code" class="form-control select2">';
                        $(res.data).each(function (idx, v) {
                            html += '<option value="'+ v.state_code+'">'+ v.state +'</option>';
                        });
                        html += '</select>';

                        $('#provinces').html(html).show();
                        $('.select2').select2();

                        findUsCities('AK');

                        $('#state_code').change(function () {
                            let state_code = $(this).val();
                            findUsCities(state_code);
                        });
                    } else {
                        $('#provinces').hide().html('');
                        $('#cities').hide().html('');
                    }
                }
            });
        }
        function findUsCities(state_code) {
            $.ajax({
                url : '/state/' + state_code + '/city',
                contentType: 'json',
                success: function (res) {
                    if (res.data.length > 0) {
                        let html = '<label for="city">City </label>';
                        html += '<select name="city" id="city" class="form-control select2">';
                        $(res.data).each(function (idx, v) {
                            html += '<option value="'+ v.name+'">'+ v.name +'</option>';
                        });
                        html += '</select>';

                         $('#cities').html(html).show();
                         $('.select2').select2();

                        $('#state_code').change(function () {
                            let state_code = $(this).val();
                            findUsCities(state_code);
                        });
                    } else {
                        $('#provinces').hide().html('');
                        $('#cities').hide().html('');
                    }
                }
            });
        }
   
</script>

<script>
    $( document ).ready(function() {
        
        $('#country_id').change(function () {
            var city = $('#country_id').val();
            getCity(city);
        });
        function getCity(city) {
            $.get('/api/getCountry/'+ city + '/province/', function (data) {
                if (data ) {
                    let html = '<label for="province_id">Departamento </label>';
                    html += '<select name="province_id" id="province_id" onchange="getProvince()" class="form-control select2">';
                        $(data).each(function (idx, v) {
                            console.log(v)
                        html += '<option value="'+ v.id+'">'+ v.province +'</option>';
                        });
                        html += '</select>';
                    
                    $('#provinces').html(html).show();
                }
            });
        }

        $('#province_id').change(function () {
            getProvince(province);
        });
        
       
    });
    function getProvince() {
    var province = $('#province_id').val();
    console.log(province)
    $.get('/api/getProvince/'+ province + '/city/', function (data) {
    if (data) {
    let html = '<label for="city">Ciudad </label>';
    html += '<select name="city" id="city" class="form-control select2">';
        $(data).each(function (idx, v) {
        html += '<option value="'+ v.id+'">'+ v.city +'</option>';
        });
        html += '</select>';
    
    $('#cities').html(html).show();
    }
    
    
    });
    }
</script>
@endsection