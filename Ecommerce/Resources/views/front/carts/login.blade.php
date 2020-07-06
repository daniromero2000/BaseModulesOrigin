@extends('layouts.front.app')
@section('content')
<hr>
<section class="container content">
    <div class="row">
        <div class="col-md-12">@include('generals::layouts.errors-and-messages')</div>
        <div class="col-md-5">
            <h2>Ingresa tu email para continuar la compra</h2>
            <form action="{{ route('cart.login') }}" method="post" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control"
                        placeholder="Email" autofocus>
                </div>
                <div class="row">
                    <button class="btn btn-primary btn-block" type="submit">Continuar</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection