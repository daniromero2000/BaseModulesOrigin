<div class="row mx-0 py-3 justify-content-center" style="margin-bottom: 10%;">
    <div class="col-lg-4 col-xl-4 d-flex col-md-6 col-sm-8">
        <div class="product-description text-center w-100 p-2 my-auto">
            <div class="w-100">
                <div class="w-100">
                    <h4 class="">{{ $product->name }}
                    </h4>
                </div>
                <div id="priceProduct pl-2" style=" position: relative; " style=" position: relative; ">
                    @if ($product->sale_price > 0)
                    <div class="card-products-discount text-center">
                        @php
                        $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                        @endphp
                        <p>{{$discount}}%</p>
                        <p>Dcto</p>
                    </div>
                    @endif
                    @if ($product->sale_price > 0)
                    <p class="text-center" style=" font-size: 24px;margin-bottom: 0px;">
                        <small>
                            <del>${{ number_format($product->price, 0) }} </del> </small>
                    </p>
                    <p class="text-center" style=" font-size: 30px;line-height: 24px; ">
                        <small><b>
                                ${{ number_format($product->sale_price, 0) }}
                            </b>
                        </small><br>
                    </p>
                    @else
                    <p class="text-center" style=" font-size: 30px;line-height: 24px;">
                        <small>
                            ${{ number_format($product->price, 0) }} </small>
                        <br>
                    </p>
                    @endif
                </div>
            </div>
            <div class="description text-center">{!! $product->description !!}</div>
            <br>
            <div class="w-100">
                <div class="w-100">
                    @include('generals::layouts.errors-and-messages')
                    <form action="{{ route('cart.store') }}" class="form-inline" method="post">
                        {{ csrf_field() }}
                        @if(isset($productAttributes) && !$productAttributes->isEmpty())
                        <div class="w-100">
                            <div class="form-group  mb-2">
                                <div class="w-100">
                                    <label class=" mb-2" for="productAttribute"><span class="mr-auto"><b>Elige tu
                                                talla</b></span></label>
                                </div>

                                <div class="container-sizes w-100" id="sizes">
                                    <input type="hidden" required name="productAttribute" id="productAttribute">
                                    @foreach($productAttributes as $productAttribute)
                                    @foreach($productAttribute->attributesValues as $key => $value)
                                    @if ($value->attribute->name == 'Talla')
                                    <div class="sizes" onclick="addValue({{$productAttribute->id}})">
                                        <span class="m-auto" onclick="addValue({{$productAttribute->id}})">
                                            <p class="m-auto">{{ ucwords($value->value) }}</p>
                                        </span>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <hr>
                        @endif
                        <div class="row mx-0 w-100">
                            <div class=" col-xl-12">
                                <div class="input-group mx-auto">
                                    <div class="input-group mb-3 container-quanty mx-auto">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-sm minus-btn" onclick="res()"
                                                id="minus-btn"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <input type="text" id="qty_input" name="quantity"
                                            class="form-control form-control-sm text-center" value="1" min="1">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-sm plus-btn" onclick="sum()"
                                                id="plus-btn"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <input type="hidden" id="qty_input_real" class="" value="1" min="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <button type="button" onclick="addCart({{$product->id}},'1')"
                                    class="btn button-reset btn-block mx-auto mt-2">
                                    Agregar al Carrito
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 order-lg-first">
        <div class="p-2 d-flex">
            <div class="horVerSlider" data-desktop="600" data-tabportrait="600" data-tablandscape="600"
                data-mobilelarge="375" data-mobilelandscape="500" data-mobileportrait="375">
                <div class="close"></div>
                <div class="vertical-wrapper">
                    <div id="vertical-slider">
                        <ul id="productImages">
                            <li class="ui-draggable ui-draggable-handle ui-draggable-disabled">
                                <img class="img-fluid" src="{{ asset("storage/$product->cover") }}"
                                    alt="{{$product->name}}" style=" border-radius: 6px; "></li>
                            @if(isset($images) && !$images->isEmpty())
                            @foreach($images as $image)
                            <li class="ui-draggable ui-draggable-handle ui-draggable-disabled">
                                <img class="img-fluid" src="{{ asset("storage/$image->src") }}" alt="{{$image->src}}"
                                    style=" border-radius: 6px; "></li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="horizon-wrapper ">
                    <div class="horizone-nav">
                        <div class="prev" style="display: none;">
                            <div>
                                <i class="fas fa-chevron-left"></i>
                            </div>
                        </div>
                        <div class="next" style="display: block;">
                            <div>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <div id="horizon-slider" class="zoomin zoomenable zoomed">
                        <ul id="productImages">
                            <li class="ui-draggable ui-draggable-handle ui-draggable-disabled">
                                <img class="img-fluid" src="{{ asset("storage/$product->cover") }}"
                                    alt="{{$product->name}}" style=" border-radius: 15px; "></li>
                            @if(isset($images) && !$images->isEmpty())
                            @foreach($images as $image)
                            <li class="ui-draggable ui-draggable-handle ui-draggable-disabled"> <img class="img-fluid"
                                    src="{{ asset("storage/$image->src") }}" alt="{{$product->name}}"
                                    style=" border-radius: 15px; "></li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="dots">
                        <div class="dotwrap"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>