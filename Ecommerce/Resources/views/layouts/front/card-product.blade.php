<div class="{{ $background }}" id="carrousel-reset" style="display: none">
    <div class="text-center content-title-banner-products">
        <h3 class="title-interesing">
            {{$title}}
        </h3>
    </div>
    <div class="px-4 px-lg-5 pb-4 pt-2 container-reset">
        <div class="glider-contain">
            <div class="glider">
                @foreach ($bestSellers as $item)
                <div class="p-1 p-sm-3">
                    {{-- <div class="card border-0" style=" border-radius: 11px; ">
                        <div class="card-body p-2 d-flex">
                            <a class="cursor" href="{{route('front.category.slug', $item->slug)}}">
                                <img style="border-radius: 10px 10px 0px 0px;" src="{{ asset('/img/tws/categorytest3.png') }}"
                                    class="w-100" alt="{{ $item->name }}">
                            </a>
                            <a href="{{ route('front.get.product', str_slug($item->slug)) }}"
                                style="text-decoration: none;margin: auto;">
                                <img data-src="{{ asset('storage/'.$item->cover) }}" alt="{{ $item->slug }}"
                                    class="img-card-product m-auto lazy">
                            </a>
                        </div>
                        <div class="w-100 p-2">
                            <div class="container-price-slider">
                                @if ($item->sale_price > 0)
                                <p class="text-center price-old-card-slider">
                                    <del>${{ number_format($item->price, 0) }} </del>
                                </p>
                                <p class="text-center price-new-card-slider">
                                    <b>
                                        ${{ number_format($item->sale_price, 0) }}
                                    </b>
                                    <br>
                                </p>
                                @else
                                <p class="text-center price-new-card-slider">

                                    ${{ number_format($item->price, 0) }}
                                    <br>
                                </p>
                                @endif
                            </div>
                            <div class="text-center">
                                <a href="{{ route('front.get.product', str_slug($item->slug)) }}"
                                    class="btn btn-primary btn-add-card mb-1">AÑADIR AL CARRITO</a>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card border-0 text-center card-products">
                        <div class="height-container-img-product relative container-img-product">
                            @if ($item->sale_price > 0)
                            @php
                            $discount = round((($item->price - $item->sale_price) / $item->price) * 100);
                            @endphp
                            <div class="ribbon-wrapper ribbon-lg">
                                <div class="ribbon bg-danger p-0">
                                    <p class="ribbon-text"> - {{$discount}}%</p>
                                </div>
                            </div>
                            @endif
                            <a class="cursor" href="{{ route('front.get.product', str_slug($item->slug))}}">
                                <img src="{{ asset('img/tws/product2.png') }}" data-src="{{ asset("storage/$item->cover") }}"
                                    class="card-products-img lazy" alt="{{ $item->slug }}">
                            </a>
                            <div class="w-100">
                                <h3 class="title-products"> {{$item->name}} </h3>
                            </div>
                            @if ($item->sale_price > 0)
                            <p class="price-old">
                                <small>
                                    <del>${{ number_format($item->price, 0) }} </del> </small>
                            </p>
                            <p class="price-new">
                                <small><b>
                                        ${{ number_format($item->sale_price, 0) }}
                                    </b>
                                </small><br>
                            </p>
                            @else
                            <p class="price-new mt-2">
                                <small> <b>
                                        ${{ number_format($item->price, 0) }}
                                    </b></small>
                                <br>
                            </p>
                            @endif
                            <div class="my-2">
                                <a class="btn-cart-category" href="">AÑADIR AL CARRITO</a>
                            </div>
                        </div>
                        {{-- <div class="w-100 pt-2 px-2 text-center">
                            <div class="w-100">
                                <h3 class="title-products"> {{$product->name}} </h3>
                            </div>
                            @if ($product->sale_price > 0)
                            <p class="price-old">
                                <small>
                                    <del>${{ number_format($product->price, 0) }} </del> </small>
                            </p>
                            <p class="price-new">
                                <small><b>
                                        ${{ number_format($product->sale_price, 0) }}
                                    </b>
                                </small><br>
                            </p>
                            @else
                            <p class="price-new mt-3">
                                <small> <b>
                                        ${{ number_format($product->price, 0) }}
                                    </b></small>
                                <br>
                            </p>
                            @endif
                        </div> --}}
                        {{-- <div class="row justify-content-center">
                            <a class="text-dark" data-toggle="modal" data-target="#productModal{{ $product->id }}">
                                <div class="icons-options">
                                    <i class="fas fa-eye"></i>
                                </div>
                            </a>
                            <a class="text-dark" onclick="addWishlist({{$product->id}})">
                                <div class="icons-options">
                                    <i class="fas fa-heart"></i>
                                </div>
                            </a>
                            <a class="text-dark" href="{{ route('front.get.product', str_slug($product->slug)) }}">
                                <div class="icons-options">
                                    <i class="fas fa-external-link-square-alt"></i>
                                </div>
                            </a>
                        </div> --}}
                    </div>
                </div>
                @endforeach
            </div>
            <button class="glider-prev glider-prev-one"><i class="fas fa-caret-left slider"></i></button>
            <button class="glider-next glider-next-one"><i class="fas fa-caret-right slider"></i></button>
        </div>
    </div>
</div>