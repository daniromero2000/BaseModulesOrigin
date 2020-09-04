@extends('layouts.front.app')
@section('og')
<meta property="og:type" content="category" />
<meta property="og:title" content="{{ $category->name }}" />
<meta property="og:description" content="{{ $category->description }}" />
@if(!is_null($category->cover))
<meta property="og:image" content="{{ asset("storage/$category->cover") }}" />
@endif
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/categories/app.min.css')}}">
<link rel="stylesheet" href="{{ asset('css/front/carousel/glider.css')}}">
<script src="{{ asset('js/front/carousel/glider.js')}}"></script>
<script src="{{ asset('js/front/carousel/carousel.js')}}"></script>
<style>
    .page-item {
        margin-left: 3px;
        margin-right: 3px;
    }

    .page-link {
        border-radius: 18px !important;
        padding: .5rem .8rem !important;
        color: #82888e;
    }

    .page-item.active .page-link {
        background-color: #ba3d6b !important;
        border-color: #ad3f68 !important;
    }
</style>
@endsection
@section('content')
<div class="w-100">
    <img src="{{ asset('img/banners/banner-category.png') }}" class="img-fluid" alt="banner-categoria">
</div>

<div class="wrapper mt-5">
    <div id="content ">
        <div class="container-reset">
            <div class="row mx-auto">
                <div class="col-lg-3">
                    <nav class="navbar navbar-expand-lg navbar-light mb-2 btn-sm">
                        <div class="container-fluid mb-3">
                            <button type="button" class="btn button-reset" id="sidebarCollapse">
                                <i class="fas fa-align-left"></i>
                                Opciones
                            </button>
                        </div>
                    </nav>
                    <nav id="sidebar">
                        <div id="dismiss">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="sidebar-header">
                        </div>
                        @include('ecommerce::front.categories.sidebar-category')
                    </nav>
                    <div class="sidebar-responsive">
                        @include('ecommerce::front.categories.sidebar-category', ['attributes' => $attributes])
                    </div>
                </div>
                <div class="col-lg-9 px-1 mx-auto">
                    @include('ecommerce::front.products.product-list', ['products' => $products])
                    <nav class="mt-4" aria-label="...">
                        <ul class="pagination d-flex justify-content-center">
                            <li class="page-item @if(request()->input('skip') < 1) disabled @endif">
                                <a class="page-link"
                                    href="{{ route("front.category.slug", [ $category->slug, 'skip' => (request()->input('skip') - 1), 'q' => request()->input('q') ] ) }}"
                                    tabindex="-1" aria-disabled="true"><i class="fas fa-angle-left"></i></a>
                            </li>
                            @for ($i = 0; $i < $paginate; $i++) <li
                                class="page-item @if(request()->input('skip') == $i) active @endif"><a
                                    class="page-link "
                                    href="{{ route("front.category.slug", [ $category->slug, 'skip' => ($skip = $i), 'q' => request()->input('q') ] ) }}">{{$i + 1}}</a>
                                </li>
                                @endfor
                                @if ($paginate > 1)
                                <li class="page-item" @if((request()->input('skip') + 1) == $paginate) hidden @endif>
                                    <a class="page-link"
                                        href="{{ route("front.category.slug", [ $category->slug, 'skip' => (request()->input('skip') + 1), 'q' => request()->input('q') ] ) }}"><i
                                            class="fas fa-angle-right"></i></a>
                                </li>
                                @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@if (!empty($bestSellers))
<div class="container-reset my-4" id="carrousel-reset" style="display: none">
    <div class="text-center content-title-banner-products">
        <h4 class="title-interesing">
            También te puede interesar
        </h4>
    </div>
    <div class="px-4 px-lg-5 pb-4 pt-2">
        <div class="glider-contain">
            <div class="glider">
                @foreach ($bestSellers as $item)
                <div class="p-1 p-sm-3">
                    <div class="card border-0" style=" border-radius: 11px; ">
                        <div class="card-body p-2 d-flex">
                            <a href="{{ route('front.get.product', str_slug($item->slug)) }}"
                                style="text-decoration: none;margin: auto;">
                                <img data-src="{{ asset('storage/'.$item->cover) }}" alt="{{ $item->slug }}"
                                    class="img-card-product m-auto lazy">
                            </a>

                        </div>
                        <div class="w-100 p-2">
                            <a href="{{ route('front.get.product', str_slug($item->slug)) }}"
                                style="text-decoration: none;">
                                <p class="name-card-slider">
                                    {{$item->name}}
                                </p>
                            </a>
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
                                <button class="btn btn-primary btn-add-card mb-1" onclick="addCart({{$item->id}},'1')"
                                    type="button">AÑADIR AL
                                    CARRITO</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="glider-prev glider-prev-one"><i class="fas fa-caret-left slider"></i></button>
            <button class="glider-next glider-next-one"><i class="fas fa-caret-right slider"></i></button>
        </div>
    </div>
</div>
@endif
<div class="overlay"></div>
@endsection
@section('scripts')
<script src="{{ asset('js/front/sidebar/sidebar.js') }}"></script>

<script type="text/javascript">
    window.onload = (function(){
        $('#carrousel-reset').show();
    });
    $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
</script>
@endsection