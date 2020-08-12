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
@endsection
@section('content')
<div class="wrapper">

    <div id="content">
        <div class="w-100">
            <img src="{{ asset('img/FVN/baner-category.png')}}" class="d-block w-100" alt="baner-categorias">
        </div>
        <div class="tips">
            <img src="{{ asset('img/fvn/tips.png')}}" class="d-block w-100" alt="tips">
        </div>
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
                <div class="col-lg-9 px-1">
                    @include('ecommerce::front.products.product-list', ['products' => $products])
                </div>
            </div>
        </div>
        @if (!empty($bestSellers))
        <div class="container-reset mt-4">
            <div class="text-center content-title-banner-products">
                <h4 style=" font-size: 50px; padding: 25px; ">
                    También te puede interesar
                </h4>
            </div>
            <div class="px-4 pb-4 pt-2">
                <div class="glider-contain">
                    <div class="glider">
                        @foreach ($bestSellers as $item)
                        <a href="{{ route('front.get.product', str_slug($item->slug)) }}">
                            <div class="card-body p-2 d-flex">
                                <img src="{{ asset('storage/'.$item->cover) }}" alt="{{ $item->name }}"
                                    class="img-card-product m-auto">
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <button class="glider-prev glider-prev-one"><i class="fas fa-caret-left slider"></i></button>
                    <button class="glider-next glider-next-one"><i class="fas fa-caret-right slider"></i></button>
                </div>
            </div>
        </div>
        @endif

        <div class="w-100 ">
            <div class="container-lg py-5 px-2">
                <a href="">
                    <img src="{{ asset('img/FVN/footerCategory.png')}}" class="d-block w-100" alt="footerCategory">
                </a>
            </div>
        </div>
    </div>
</div>
<div class="overlay"></div>
@endsection
@section('scripts')
<script src="{{ asset('js/front/sidebar/sidebar.js') }}"></script>

<script type="text/javascript">
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
