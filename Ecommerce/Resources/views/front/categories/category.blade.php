@extends('layouts.front.app')
@section('og')
<meta property="og:type" content="category" />
<meta property="og:title" content="{{ $category->name }}" />
<meta property="og:description" content="{{ $category->description }}" />
@if(!is_null($category->cover))
<meta property="og:image" content="{{ asset("storage/$category->cover") }}" />
@endif
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/categories/app.css')}}">
@endsection
@endsection
@section('content')
<div class="wrapper">
    <div id="content">
        <div class="w-100">
            <img src="{{ asset('img/fvn/baner-category.png')}}" class="d-block w-100" alt="...">
        </div>
        <div class="tips">
            <img src="{{ asset('img/fvn/tips.png')}}" class="d-block w-100" alt="...">
        </div>
        <div class="container-reset">
            <div class="row mx-auto">
                <div class="col-lg-3">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 btn-sm" id="sidebarCollapse">
                        <div class="container-fluid mb-3">
                            <button type="button" class="btn button-reset">
                                <i class="fas fa-align-left"></i>
                                Opciones
                            </button>
                        </div>
                    </nav>
                    <div class="sidebar-responsive">
                        @include('ecommerce::front.categories.sidebar-category')
                    </div>
                </div>
                <div class="col-lg-9 pr-1">
                    @include('ecommerce::front.products.product-list', ['products' => $products])
                </div>
            </div>
        </div>
        <div class="w-100 background-color-blue">
            <div class="container-lg py-5 px-2">
                <a href="">
                    <img src="{{ asset('img/FVN/footerCategory.png')}}" class="d-block w-100" alt="...">
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