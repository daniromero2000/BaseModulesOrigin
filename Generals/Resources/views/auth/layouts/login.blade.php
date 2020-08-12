<div class="col-md-12">@include('generals::layouts.errors-and-messages')</div>
<div class="col-12 text-center mb-3">
    <h2 style=" font-size: 22px; color: gray; ">Ingresa tu email para continuar la compra</h2>
</div>
<div class="col-xl-4 col-lg-5 col-md-7 col-sm-10 col-11">
    <form action="{{ route('login') }}" method="post" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email" class="control-label">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control"
                placeholder="su@correo.com" autofocus>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" value="" class="form-control" placeholder="****">
        </div>
        <div class="row mx-0">
            <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
        </div>
    </form>
    <div class="row mx-0 mt-3 justify-content-center">
        {{-- <a href="{{route('password.request')}}">I forgot my password</a><br> --}}
        <a href="{{route('register')}}" class="text-center">Sin cuenta? Registrarse aquí!.</a>
    </div>
</div>