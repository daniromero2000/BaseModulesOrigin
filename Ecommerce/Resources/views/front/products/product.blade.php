@extends('generals::layouts.front.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/product/horizontalvertical.css')}}">
@endsection
@section('content')
<div class="container-xl product">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb-reset">
                <li><a href="{{ route('home') }}"> Home </a> </li>
                @if(isset($category))
                <li><a href="{{ route('front.category.slug', $category->slug) }}">{{ $category->name }}</a></li>
                @endif
                <li class="active"><span> /</span> {{ $product->name }}</li>
            </ol>
        </div>
    </div>
    @include('ecommerce::layouts.front.product')
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
    integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="{{ asset('js/front/horizontalvertical.js') }}"></script>
{{-- <script type="text/javascript">
    $(document).ready(function () {
            var productPane = document.querySelector('.product-cover');
            var paneContainer = document.querySelector('.product-cover-wrap');

            // new Drift(productPane, {
            //     paneContainer: paneContainer,
            //     inlinePane: false
            // });
        });
</script> --}}
@endsection