@extends('generals::layouts.front.app')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/home/app.css')}}">
<link rel="stylesheet" href="{{ asset('css/front/carousel/glider.css')}}">
<script src="{{ asset('js/front/carousel/glider.js')}}"></script>
<script src="{{ asset('js/front/carousel/carousel.js')}}"></script>
@endsection
@section('content')
@include('ecommerce::layouts.front.home-slider')
@include('generals::layouts.front.home.carousel')
@include('generals::layouts.front.home.banerStatements')
@if($products1->isNotEmpty())
@include('generals::layouts.front.home.sliderBestSellers')
@include('generals::layouts.front.home.banerChildrens')
@include('generals::layouts.front.home.products')
@endif
{{-- @if($cat2->products->isNotEmpty())
@php
$products2 = $cat2->products->where('status', 1);
@endphp
<div class="container">
    <div class="glider-contain">
        <div class="glider2">
            @foreach ($products2 as $item)
            <a href="{{ route('front.get.product', str_slug($item->slug)) }}">
<div class="card-body">
    <img src="{{ asset('storage/'.$item->cover) }}" alt="{{ $item->name }}">
</div>
</a>
@endforeach
</div>
<button class="glider-prev glider-prev-two">&laquo;</button>
<button class="glider-next glider-next-two">&raquo;</button>
<div id="dots2"></div>
</div>
</div> --}}
{{-- <div class="container">
    <div class="section-title b100">
        <h2>{{ $cat2->name }}</h2>
</div>
@include('ecommerce::front.products.product-list', ['products' => $cat2->products->where('status', 1)])
<div id="browse-all-btn"> <a class="btn btn-default browse-all-btn"
        href="{{ route('front.category.slug', $cat2->slug) }}" role="button">browse all items</a></div>
</div> --}}
{{-- @endif --}}
{{-- @include('mailchimp::mailchimp') --}}
@endsection