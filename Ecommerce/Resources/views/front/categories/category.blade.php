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
<div class="my-4">
    @include('ecommerce::layouts.front.card-product',['title' => 'También te puede
    interesar','background'=>'carrousel-reset'])
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