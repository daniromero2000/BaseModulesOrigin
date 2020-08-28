<div class="col-md-12">@include('generals::layouts.errors-and-messages')</div>
<div class="col-12 text-center mb-3">
    <h2 style=" font-size: 20px; color: gray; ">Inicia sesión</h2>
</div>
<div class="col-xl-4 col-lg-5 col-md-7 col-sm-10 col-11">
    <div class="row m-auto">
        <div class="col-12">
            <div class="text-center">
                <img style="width: 100px;" src="{{ asset('img/fvn/logo.png') }}" class="" alt="user login">
            </div>
        </div>
    </div>
    <form action="{{ route('login') }}" method="post" class="form-horizontal">
        {{ csrf_field() }}
        <div class="form-group">
            {{-- <label for="email" class="control-label">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control"
                placeholder="su@correo.com" autofocus> --}}
                <label for="email" class="control-label" style="color: gray;">Email</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i style="color: #4F98B9" class="fas fa-at"></i></div>
                    </div>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="form-control" placeholder="su@correo.com" autofocus>
                </div>
                {{-- <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="form-control" placeholder="su@correo.com" autofocus> --}}
        </div>
        <div class="form-group">
                <label for="password" style="color: gray;">Contraseña</label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i style="color: #4F98B9" class="fas fa-key"></i></div>
                    </div>
                    <input type="password" name="password" id="password" value="" class="form-control"
                    placeholder="****">
                </div>
                {{-- <input type="password" name="password" id="password" value="" class="form-control"
                    placeholder="****"> --}}
            </div>
            <div class="row mx-0">
                <button class="btn buton-login-modal btn-block" type="submit">Ingresar</button>
            </div>
    </form>
    <div class="row mx-0 mt-3 justify-content-center">
        {{-- <a href="{{ route('password.request') }}">I forgot my
            password</a><br> --}}
        <a class="link-register" href="{{ route('register') }}" class="text-center">¿No tienes cuenta? ¡Registrate!</a>
    </div>
</div>

