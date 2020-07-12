<div class="row">
    <div class="col-12">
        <h4 class="pl-4" style="margin-top: 9px; ">{{ $product->name }}
        </h4>
    </div>
</div>
<div class="row mx-0 py-3" style="margin-bottom: 10%;">
    <div class="col-lg-4 col-xl-4 d-flex">
        <div class="product-description w-100 p-2 my-auto">
            <div class="w-100">
                <p style=" font-size: 22px;"><small>
                        ${{ number_format($product->price, 0) }}</small></p>
            </div>
            <div class="description">{!! $product->description !!}</div>

            <hr>
            <div class="w-100">
                <div class="w-100">
                    @include('generals::layouts.errors-and-messages')
                    <form action="{{ route('cart.store') }}" class="form-inline" method="post">
                        {{ csrf_field() }}
                        @if(isset($productAttributes) && !$productAttributes->isEmpty())
                        <div class="w-100">
                            <div class="form-group  mb-2">
                                <label class=" mb-2" for="productAttribute"><span class="mr-auto">Elige
                                        Combinación</span></label> <br />
                                <select name="productAttribute" id="productAttribute" class="form-control "
                                    style=" display: block; width: 100%; ">
                                    @foreach($productAttributes as $productAttribute)
                                    <option value="{{ $productAttribute->id }}">
                                        @foreach($productAttribute->attributesValues as $value)
                                        {{ $value->attribute->name }} : {{ ucwords($value->value) }}
                                        @endforeach
                                        @if(!is_null($productAttribute->price))
                                        ( {{ config('cart.currency_symbol') }} {{ $productAttribute->price }})
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        @endif
                        <div class="row w-100">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control mx-auto" name="quantity" id="quantity"
                                        placeholder="Cantidad" value="{{ old('quantity') }}" />
                                    <input type="hidden" name="product" value="{{ $product->id }}" />
                                </div>
                            </div>
                            <div class="col-12 mt-3 d-flex">
                                <button type="button" onclick="addCart({{$product->id}},'1')"
                                    class="btn button-reset mx-auto"><i class="fa fa-cart-plus"></i> Agregar al Carrito
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
                        <ul>
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
                        <ul>
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