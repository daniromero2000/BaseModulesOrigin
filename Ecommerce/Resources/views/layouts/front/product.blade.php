<style>
.rating-header {
    margin-top: -10px;
    margin-bottom: 10px;
}
</style>

<div class="row mx-0 py-3 justify-content-center" style="margin-bottom: 10%;">
    <div class="col-lg-8 mb-3">
        <div class="p-2 d-flex">
            <div class="horVerSlider" data-desktop="600" data-tabportrait="600" data-tablandscape="600"
                data-mobilelarge="375" data-mobilelandscape="500" data-mobileportrait="375">
                <div class="close"></div>
                <div class="vertical-wrapper">
                    <div id="vertical-slider">
                        <ul>
                            <li class="ui-draggable ui-draggable-handle ui-draggable-disabled">
                                <img class="img-fluid lazy" data-src="{{ asset("storage/$product->cover") }}"
                                    alt="{{$product->slug}}" style=" border-radius: 6px; "></li>
                            @if(isset($images) && !$images->isEmpty())
                            @foreach($images as $image)
                            <li class="ui-draggable ui-draggable-handle ui-draggable-disabled">
                                <img class="img-fluid lazy" data-src="{{ asset("storage/$image->src") }}"
                                    alt="{{$product->slug}}" style=" border-radius: 6px; "></li>
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
                    <div id="horizon-slider">
                        <ul>
                            <li class="ui-draggable bg-white zoom-img">
                                <img class="img-fluid zoom lazy" data-src="{{ asset("storage/$product->cover") }}"
                                    alt="{{$product->slug}}" style=" border-radius: 15px; "></li>
                            @if(isset($images) && !$images->isEmpty())
                            @foreach($images as $image)
                            <li class="ui-draggable ui-draggable-handle ui-draggable-disabled bg-white zoom-img"> <img
                                    class="img-fluid zoom lazy" data-src="{{ asset("storage/$image->src") }}"
                                    alt="{{$product->slug}}" style=" border-radius: 15px; "></li>
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
    <div class="col-lg-4 col-xl-4 d-flex col-md-6 col-sm-8 ">
        <div class="product-description text-center w-100 p-2 my-auto">
            <div class="w-100">
                <div class="w-100">
                    <h4 class="">{{ $product->name }}
                    </h4>
                </div>
                <div id="priceProduct{{$product->id}} pl-2" style=" position: relative; ">
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
                                <div class="w-100 justify-content-between d-flex">
                                    <label class=" mb-2" for="productAttribute"><span class="mr-auto"><b>Elige tu
                                                talla</b></span></label>

                                    <a data-toggle="modal" data-target="#sizeGuide" class="text-dark" href="">
                                        <label class=" mb-2" for="productAttribute"><span class="mr-auto"><b>Ver tabla
                                                    de tallas</b></span></label></a>
                                </div>

                                <div class="container-sizes w-100" id="sizes">
                                    <input type="hidden" required name="productAttribute" id="productAttribute">
                                    @foreach($productAttributes as $productAttribute)
                                    {{-- <input type="hidden" required value="{{$productAttribute->sale_price}}"
                                    id="saleprice{{$productAttribute->id}}">sale

                                    <input type="hidden" required value="{{$productAttribute->price}}"
                                        id="price{{$productAttribute->id}}">price --}}

                                    @foreach($productAttribute->attributesValues as $key => $value)
                                    @if ($value->attribute->name == 'Talla')

                                    {{-- <input type="hidden" required value="{{$product->id}}"
                                    id="productId{{$productAttribute->id}}">product --}}

                                    <div class="sizes" id="sizes{{$productAttribute->id}}"
                                        onclick="addValue({{$productAttribute->id}})">
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
                                    Agregar al carrito
                                </button>
                            </div>
                            <div class="col-xl-12">
                                <button type="button" onclick="addWishlist({{$product->id}},'2')"
                                    class="btn button-reset btn-block mx-auto mt-2">
                                    Agregar a lista de deseos
                                </button>
                            </div>
                            <div class="col-xl-12">
                            
                                <button type="button" @auth data-toggle="modal" data-target="#produtcReviewModal" @endauth data-backdrop="static" data-keyboard="false" id="triggerProductReviewModal" class="btn button-reset btn-block mx-auto mt-2 ">
                                    Calificar Producto @auth - <span class="selected-rating valid" data-attr="">0</span><small> / 5</small>@endauth
                                </button>
                            

                                
                            </div>

                            <div class="modal fade" id="produtcReviewModal" tabindex="-1" role="dialog"
                                aria-labelledby="produtcReviewModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title ">Calificar Producto </h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row" id="rating-ability-wrapper">
                                                <label for="comment"  class="control-label col-md-12 d-flex justify-content-center mt-2 mb-3">
                                                    <textarea id='comment' class="w-100" name="comment" placeholder="Comparte tu opinión con el vededor!"></textarea>
                                                </label>
                                                <label class="col-md-12  control-label d-flex justify-content-center"
                                                    for="rating">
                                                    <span class="field-label-header">Que tal te parece este
                                                        producto</span><br>
                                                    <span class="field-label-info"></span>
                                                    <input type="hidden" id="selected_rating" name="selected_rating"
                                                        value="" required="required">
                                                    <input type="hidden" id="product_id" name="product_id"
                                                        value="{{$product->id}}" required="required">
                                                </label>                                                
                                                <div class="col-md-12 d-flex justify-content-center mt-2 mb-2">
                                                    <button type="button" class="btnrating btn btn-default btn-lg border-0"
                                                        data-attr="1" id="rating-star-1">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btnrating btn btn-default btn-lg border-0"
                                                        data-attr="2" id="rating-star-2">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btnrating btn btn-default btn-lg border-0"
                                                        data-attr="3" id="rating-star-3">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btnrating btn btn-default btn-lg border-0"
                                                        data-attr="4" id="rating-star-4">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btnrating btn btn-default btn-lg border-0"
                                                        data-attr="5" id="rating-star-5">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-center mt-2">
                                                    <h2 class="bold rating-header" >
                                                        <span class="selected-rating">0</span><small> / 5</small>
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="createProductReview" disabled class="btn button-reset" data-dismiss="modal">Enviar Calificaci&oacute;n</button>                                            
                                            <button type="button" @guest id="cancelReview" @endguest class="btn btn-secondary" data-dismiss="modal">Cancelar </button>
                                        </div>
                                    </div>
                                </div>
                            </div>








                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@include('ecommerce::layouts.front.modal_size_guide')

@if (!empty($bestSellers))
<div class="container-reset my-4">
    <div class="text-center content-title-banner-products">
        <h4 class="title-interesing">
            También te puede interesar
        </h4>
    </div>
    <div class="px-4 pb-4 pt-2">
        <div class="glider-contain">
            <div class="glider">
                @foreach ($bestSellers as $item)
                <a href="{{ route('front.get.product', str_slug($item->slug)) }}">
                    <div class="card-body p-2 d-flex">
                        <img data-src="{{ asset('storage/'.$item->cover) }}" alt="{{ $item->slug }}"
                            class="img-card-product m-auto lazy">
                    </div>
                </a>
                @endforeach
            </div>
            <button class="glider-prev glider-prev-one"><i class="fas fa-caret-left slider"></i></button>
            <button class="glider-next glider-next-one"><i class="fas fa-caret-right slider"></i></button>
        </div>
    </div>
    <div class="py-2 py-md-5">
        <a>
            <img class="img-fluid banner-product-rounded" src="{{asset('img/FVN/banner03.jpg')}}" alt="feels-very-nice">
        </a>
    </div>
</div>

@endif