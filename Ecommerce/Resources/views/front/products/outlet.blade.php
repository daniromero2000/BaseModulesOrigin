@extends('layouts.front.app')
@section('og')
<meta property="og:type" content="category" />
{{-- <meta property="og:title" content="{{ $category->name }}" /> --}}
{{-- <meta property="og:description" content="{{ $category->description }}" /> --}}
{{-- @if(!is_null($category->cover)) --}}
{{-- <meta property="og:image" content="{{ asset("storage/$category->cover") }}" /> --}}
{{-- @endif --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/categories/app.css')}}">
@endsection
@endsection

@section('content')
<div class="wrapper">
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>

        <div class="sidebar-header p-4">
        </div>
        {{-- @include('ecommerce::front.categories.sidebar-category') --}}
    </nav>
    <div id="content">
        <div class="w-100">
            <img src="{{ asset('img/fvn/baner-category.png')}}" class="d-block w-100" alt="...">
        </div>
        <div class="tips">
            <img src="{{ asset('img/fvn/tips.png')}}" class="d-block w-100" alt="...">
        </div>
        <div class="container-reset">
            <div class="row mx-auto">
                <div class="col-lg-12 pr-1">
                    @if(!empty($products) && !collect($products)->isEmpty())

                    <div class="row mx-0 text-center justify-content-center">
                        @foreach($products as $product)
                        <div class="col-xl-3 col-md-4 col-sm-6 col-xs-12 mb-4">
                            <div class="single-product">
                                <div class="product">
                                    @if(isset($product->cover))
                                    <div class="card border-0 text-center card-products">
                                        <div class="height-container-img-product">
                                            <img src="{{ asset("storage/$product->cover") }}" class="card-products-img"
                                                alt="{{ asset("storage/$product->cover") }}">
                                        </div>
                                        <div class="card-body pt-3 pb-0 pr-3 pl-3">
                                            <p class="title-product">{{$product->name}}</p>
                                            <p class="mb-1 price-product">${{ number_format($product->price, 0)}}</p>
                                        </div>
                                        <div class="row justify-content-center">
                                            <a class="text-dark" data-toggle="modal"
                                                data-target="#productModal{{ $product->id }}">
                                                <div class="icons-options">
                                                    <i class="fas fa-eye"></i>
                                                </div>
                                            </a>
                                            <a class="text-dark" href="">
                                                <div class="icons-options">
                                                    <i class="fas fa-heart"></i>
                                                </div>
                                            </a>
                                            <a class="text-dark"
                                                href="{{ route('front.get.product', str_slug($product->slug)) }}">
                                                <div class="icons-options">
                                                    <i class="fas fa-external-link-square-alt"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @else
                                    <img src="https://placehold.it/263x330" alt="{{ $product->name }}"
                                        class="height-container-img-product" />
                                    @endif

                                </div>
                                <div class="modal fade" id="productModal{{ $product->id }}" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" role="dialog"
                                    aria-labelledby="productModal{{ $product->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-content">
                                                <div class="row mx-0 justify-content-end">
                                                    <button type="button" class="close mr-2 mt-1" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                @include('ecommerce::layouts.front.modal-product')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if($products instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">{{ $products->links() }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @else
                    <p class="alert alert-warning">No hay productos aún</p>
                    @endif
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