<nav class="navbar navbar-expand-lg navbar-light bg-blue-page">
    <div class="text-white mx-auto container-reset text-center relative">
        ENVIOS A TODO COLOMBIA <img src="{{ asset('img/fvn/logo-colombia.svg')}}" class="logo-send" alt="colombia">
        <div class="absolute social-icon-header">
            <img src="{{ asset('img/fvn/facebook.png')}}" alt="facebook">
            <img src="{{ asset('img/fvn/instagram.png')}}" alt="instagram">
            <img src="{{ asset('img/fvn/youtube.png')}}" alt="youtube">
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light py-sm-3">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand container-logo" href="/"><img class="logo" src="{{ asset('img/fvn/logo.png') }}"
                alt="logo_fvn"></a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <div class="content-link">
                <ul class="navbar-nav pr-lg-5 mr-xl-5 ml-auto justify-content-between mt-2 mt-lg-0 content-headers">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">HOME <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">NIÑO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">NIÑA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FISIOLÓGICO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style=" color: #dc467b; "><b>OUTLET</b></a>
                    </li>
                </ul>
            </div>
            <form class="form-inline my-2 my-lg-0">
                <div class="search">
                    <input type="text" name="" placeholder="Buscar" class="text">
                    <button type="submit" class="btn-search"><i class="fa fa-search "></i></button>
                </div>
            </form>
            <div class="text-center">
                <a href="/cart">
                    <img src="{{ asset('img/fvn/cart.png')}}" alt="" style=" width: 38px; margin: 0px 12px; ">
                </a>
            </div>
        </div>
    </div>

</nav>
<div class="social">
    <ul>
        <li><a href="#" target="_blank" class="icon-facebook"> <i class="fab fa-facebook-f"></i></a></li>
        <li><a href="#" target="_blank" class="icon-instagram"> <i class="fab fa-instagram"></i></a></li>
        <li><a href="#" target="_blank" class="icon-youtube"><i class="fab fa-youtube"></i></a></li>
        {{-- <li><a href="#" class="icon-mail"></a></li> --}}
    </ul>
</div>