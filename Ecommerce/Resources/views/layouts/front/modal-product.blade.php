<div class="row mx-0 py-3">
    <div class="col-md-7">
        <div class="p-2">
            @if(isset($product->cover))
            <img id="main-image" class="img-fluid" src="{{ asset("storage/$product->cover") }}?w=400"
                data-zoom="{{ asset("storage/$product->cover") }}?w=1200">
            @else
            <img id="main-image" class="img-fluid" src="https://placehold.it/300x300"
                data-zoom="{{ asset("storage/$product->cover") }}?w=1200" alt="{{ $product->name }}">
            @endif
            {{-- @if(isset($images) && !$images->isEmpty())
            @foreach($images as $image)
            <li>
                <a href="javascript: void(0)">
                    <img class="img-responsive img-thumbnail" src="{{ asset("storage/$image->src") }}"
            alt="{{ $product->name }}" />
            </a>
            </li>
            @endforeach
            @endif --}}
        </div>
    </div>
    <div class="col-md-5">
        <div class="product-description p-2">
            <h4 style=" font-size: 20px; margin-top: 9px; ">{{ $product->name }}
            </h4>
            <div>
                <p><small>{{ config('cart.currency') }} {{ $product->price }}</small></p>
            </div>
            <div class="description">{!! $product->description !!}</div>
            {{-- <div class="excerpt">
                <hr>{!! str_limit($product->description, 100, ' ...') !!}</div> --}}
            <hr>
            <div class="row">
                <div class="col-md-12">
                    @include('generals::layouts.errors-and-messages')
                    <form action="{{ route('cart.store') }}" class="form-inline" method="post">
                        {{ csrf_field() }}
                        @if(isset($productAttributes) && !$productAttributes->isEmpty())
                        <div class="w-100">
                            <div class="form-group  mb-2">
                                <label class=" mb-2" for="productAttribute"><span class="mr-auto">Elige
                                        Combinación</span></label> <br />
                                <select name="productAttribute" id="productAttribute{{$product->id}}"
                                    class="form-control " style=" display: block; width: 100%; ">
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
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control mx-auto" name="quantity"
                                        id="quantity{{$product->id}}" placeholder="Cantidad"
                                        value="{{ old('quantity') }}" />
                                    <input type="hidden" name="product" value="{{ $product->id }}" />
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="button" onclick="addCart({{$product->id}},'2')"
                                    class="btn button-reset"><i class="fa fa-cart-plus"></i> Agregar
                                    al Carrito
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>