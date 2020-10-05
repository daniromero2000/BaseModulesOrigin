@extends('layouts.front.app')
@section('styles')
<style>

</style>

@endsection
@section('content')
<div style="width: 100%; background-color: black; text-align: center; color: white; margin: auto;" class="row row-reset">
    <div class="m-auto py-2">
        <h1>Mi lista de deseos</h1>
    </div>
</div>
<div class="w-100">
    <img src="{{ asset('img/banners/banner-category.png') }}" class="img-fluid" alt="banner-categoria">
</div>
<section class="container-reset content-empty content">
</section>
@endsection
