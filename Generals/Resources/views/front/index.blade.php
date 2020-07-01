@extends('generals::layouts.front.app')
@section('og')
<meta property="og:type" content="home" />
<meta property="og:title" content="{{ config('app.name') }}" />
<meta property="og:description" content="{{ config('app.name') }}" />
@endsection

@section('content')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Laravel</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<!-- Styles -->
<style>
    html,
    body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links>a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                Lagobo
            </div>

        </div>
    </div>
</body>

@endsection

@section('content')
@include('ecommerce::layouts.front.home-slider')

@if($cat1->products->isNotEmpty())
<section class="new-product t100 home">

    <div class="container">
        <div class="section-title b50">
            <h2>{{ $cat1->name }}</h2>
        </div>
        @include('ecommerce::front.products.product-list', ['products' => $cat1->products->where('status', 1)])
        <div id="browse-all-btn"> <a class="btn btn-default browse-all-btn"
                href="{{ route('front.category.slug', $cat1->slug) }}" role="button">browse all items</a></div>
    </div>
</section>
@endif
<hr>
@if($cat2->products->isNotEmpty())
<div class="container">

    <div class="section-title b100">
        <h2>{{ $cat2->name }}</h2>
    </div>
    @include('ecommerce::front.products.product-list', ['products' => $cat2->products->where('status', 1)])
    <div id="browse-all-btn"> <a class="btn btn-default browse-all-btn"
            href="{{ route('front.category.slug', $cat2->slug) }}" role="button">browse all items</a></div>
</div>
@endif
<hr />
@include('mailchimp::mailchimp')
@endsection