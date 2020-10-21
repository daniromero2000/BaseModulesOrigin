@extends('layouts.front.app')
@section('styles')
<style>

</style>

@endsection
@section('content')
<div style="background-color: black; text-align: center; color: white; margin: auto;" class="row row-reset">
    <div class="m-auto py-2">
        <img src="{{ asset('img/banners/banner-wishlist.png') }}" class="img-fluid" alt="banner-categoria">
    </div>
</div>
<div class="">
    <img src="{{ asset('img/banners/model-banner.png') }}" class="img-fluid" alt="banner-categoria">
</div>
<div class="row row-reset" style="background-color: #F8FBFD; color: #414250; padding: 45px 10px;">
    <div class="col-6 col-md-8 m-auto">
        <div class="text-center m-auto">
            <ul class="nav text-center">
                <li class="active"><a style="padding: 0px 50px; font-size: 30px; color: #414250; font-weight: 400;" data-toggle="tab" href="#home">TUS LISTAS</a></li>
                <li><a style="padding: 0px 50px; font-size: 30px; color: #414250; font-weight: 400;" data-toggle="tab" href="#menu1">TUS LISTAS DE IDEAS</a></li>
                <li><a style="padding: 0px 50px; font-size: 30px; color: #414250; font-weight: 400;" data-toggle="tab" href="#menu2">TUS AMIGOS</a></li>
            </ul>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="text-center">
            <h3 style="font-weight: 400; background-color: #CCE2E6; padding: 20px 0px; border-radius: 20px;">CREAR TU LISTA</h3>
        </div>
    </div>
</div>
<div class="row row-reset">
    <div class="col-4 col-md-2">
        <div>
            <div class="text-center mt-5" style="background-color: #FAD0CC; padding: 15px 0px; border-radius: 10px;">
                <div class="dropdown">
                    <a style="font-size: 30px; font-weight: 100; color: #414250;" class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    HILARY FOX
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-10">
        <div class="tab-content" style="padding: 42px 40px;">
            <div id="home" class="tab-pane fade in active">
                <div class="row row-reset" style="color: #414250">
                    <div class="col-12 text-left">
                        <h4 style="font-weight: 400">LISTA DE COMPRAS <span style="font-size: 15px; margin-left: 50px;">Privada</span> </h4>
                    </div>
                </div>
                <div class="row row-reset" style="color: #414250; border-bottom: solid 2px #9C9C9C; padding: 10px 0px;">
                    <div class="col-6">
                        <h4 style="font-weight: 400"><i class="fas fa-user"></i> <span style="font-size: 15px;">Invitar</span> </h4>
                    </div>
                    <div class="col-6 text-right">
                        <h4 style="font-weight: 400"><span style="font-size: 18px;"><i class="fas fa-share-alt"></i> Enviar lista a otras personas</span> | ... Más</h4>
                    </div>
                </div>
                <div class="row row-reset">
                    <div class="col-12 col-md-6">
                        <div>

                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div>
                            <div class="active-pink-3 active-pink-4 mb-4 pt-4">
                                <i style="
                                position: absolute; margin-left: 86%; margin-top: 2%; font-size: 20px;" class="fas fa-search"></i>
                                <input style="border-radius: 25px; background-color: #DCDDDC; border: none;" class="form-control" type="text" aria-label="Search">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div>
                            <div class="active-pink-3 active-pink-4 mb-4 pt-4">
                                <h5>Filtrar y Ordenar</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-reset mt-4" style="border-bottom: solid 2px #878787;">
                    <div class="col-12 col-md-8">
                        <div class="row row-reset">
                            <div class="col-12 col-md-4">
                                <div class="m-auto">
                                    <img src="{{ asset('img/tws/product1.png') }}" class="img-fluid" alt="banner-categoria">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <p style="font-size: 18px; font-weight: 700; color: #2669B1;">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Voluptatem iure aspernatur repellat ullam repellendus
                                    ipsam rem officiis? Adipisci est distinctio reprehenderit?
                                    Illo expedita eum doloribus exercitationem eveniet vitae nemo iusto?
                                </p>
                                <h3>€ 26,00</h3>
                                <span style="font-size: 17px; color: #2669B1; font-weight: 600;">2 De 2 mano y nuevo <span style="color: black;">desde </span><span style="color:#BB2625">$ 26.000</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="m-auto">
                            <div class="text-center">
                                <h5 class="my-4">Artículo añadido 3 de agosto de 2020</h5>
                                <a class="my-2" style="    background-color: #2F363A; color: white; padding: 12px 100px; border-radius: 40px; font-weight: 400;" href="">AÑADIR A LA CESTA</a>
                            </div>
                            <div class="mt-4 text-center">
                                <div>
                                    <a style="color: #2F363A" href="">ELIMINAR PRODUCTO</a>
                                </div>
                                <div>
                                    <a style="color: #2F363A" href="">AGREGAR COMENTARIO Y PRIORIDAD</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-reset mt-4" style="border-bottom: solid 2px #878787;">
                    <div class="col-12 col-md-8">
                        <div class="row row-reset">
                            <div class="col-12 col-md-4">
                                <div class="m-auto">
                                    <img src="{{ asset('img/tws/product2.png') }}" class="img-fluid" alt="banner-categoria">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <p style="font-size: 18px; font-weight: 700; color: #2669B1;">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Voluptatem iure aspernatur repellat ullam repellendus
                                    ipsam rem officiis? Adipisci est distinctio reprehenderit?
                                    Illo expedita eum doloribus exercitationem eveniet vitae nemo iusto?
                                </p>
                                <h3>€ 26,00</h3>
                                <span style="font-size: 17px; color: #2669B1; font-weight: 600;">2 De 2 mano y nuevo <span style="color: black;">desde </span><span style="color:#BB2625">$ 26.000</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="m-auto">
                            <div class="text-center">
                                <h5 class="my-4">Artículo añadido 3 de agosto de 2020</h5>
                                <a class="my-2" style="    background-color: #2F363A; color: white; padding: 12px 100px; border-radius: 40px; font-weight: 400;" href="">AÑADIR A LA CESTA</a>
                            </div>
                            <div class="mt-4 text-center">
                                <div>
                                    <a style="color: #2F363A" href="">ELIMINAR PRODUCTO</a>
                                </div>
                                <div>
                                    <a style="color: #2F363A" href="">AGREGAR COMENTARIO Y PRIORIDAD</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-reset mt-4" style="border-bottom: solid 2px #878787;">
                    <div class="col-12 col-md-8">
                        <div class="row row-reset">
                            <div class="col-12 col-md-4">
                                <div class="m-auto">
                                    <img src="{{ asset('img/tws/product1.png') }}" class="img-fluid" alt="banner-categoria">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <p style="font-size: 18px; font-weight: 700; color: #2669B1;">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Voluptatem iure aspernatur repellat ullam repellendus
                                    ipsam rem officiis? Adipisci est distinctio reprehenderit?
                                    Illo expedita eum doloribus exercitationem eveniet vitae nemo iusto?
                                </p>
                                <h3>€ 26,00</h3>
                                <span style="font-size: 17px; color: #2669B1; font-weight: 600;">2 De 2 mano y nuevo <span style="color: black;">desde </span><span style="color:#BB2625">$ 26.000</span></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="m-auto">
                            <div class="text-center">
                                <h5 class="my-4">Artículo añadido 3 de agosto de 2020</h5>
                                <a class="my-2" style="    background-color: #2F363A; color: white; padding: 12px 100px; border-radius: 40px; font-weight: 400;" href="">AÑADIR A LA CESTA</a>
                            </div>
                            <div class="mt-4 text-center">
                                <div>
                                    <a style="color: #2F363A" href="">ELIMINAR PRODUCTO</a>
                                </div>
                                <div>
                                    <a style="color: #2F363A" href="">AGREGAR COMENTARIO Y PRIORIDAD</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Some content in menu 1.</p>
            </div>
            <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Some content in menu 2.</p>
            </div>
        </div>
    </div>
</div>
<section class="container-reset content-empty content">
</section>
@endsection
