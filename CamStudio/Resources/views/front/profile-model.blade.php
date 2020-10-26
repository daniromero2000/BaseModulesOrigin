@extends('layouts.front.app')
@section('styles')

@endsection
@section('content')
<div style="background-color: #090909;">
    <div style="background-image:url(../img/lfc/backgroundprofile.png); background-size:cover; height: 4600px;">
        <div class="row row-reset">
            <div style="z-index: 9;" class="col-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">
                <h1 style="color: #ECCDC9; font-size: 130px; font-weight: 400; line-height: 115px; margin-top: 70%; margin-left: 50%;">HILARY <br>FOX</h1>
                <h4 style="color: #ECCDC9; font-size: 50px; margin-left: 50%;">#SWEETCARAMEL</h4>
                <h4 style="color: white; font-size: 30px; margin-left: 50%;"><i class="fas fa-heart"></i> FOLLOW ME</h4>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7">
                <img style="width:90%;margin-top: 30%; margin-left: -5%;" src="{{ asset('img/lfc/pack5.png') }}" alt="logo_fvn">
            </div>
        </div>
        <div class="row row-reset" style="margin-top: 5%; text-align: center;">
            <div class="col-12 col-md-12">
                <h1 style="font-size: 90px; font-weight: 400;">ABOUT ME</h1>
            </div>
        </div>
        <div class="row row-reset" style="margin-top: 7%; text-align: center;">
            <div class="col-12 col-md-12">
                <h5 style="font-size: 70px; font-weight: 100; color:white">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Nam totam eveniet saepe nihil sapiente commodi quasi cum
                    vel? Saepe inventore pariatur fuga nemo nihil beatae sunt.
                    Quasi maiores tempore rem!. Lorem ipsum dolor sit amet
                    consectetur adipisicing elit. Nam totam eveniet saepe nihil
                    sapiente commodi quasi cum vel? Saepe inventore pariatur
                    fuga nemo nihil beatae sunt. Quasi maiores tempore rem!
                </h5>
            </div>
        </div>
        <div class="container">
            <div class="gallery">
                <figure class="gallery__item gallery__item--1">
                    <img src="{{ asset('img/lfc/pack5.png') }}" alt="Gallery image 1" class="gallery__img">
                </figure>
                <figure class="gallery__item gallery__item--2">
                    <img src="{{ asset('img/lfc/pack5.png') }}" alt="Gallery image 2" class="gallery__img">
                </figure>
                <figure class="gallery__item gallery__item--3">
                    <img src="{{ asset('img/lfc/pack5.png') }}" alt="Gallery image 3" class="gallery__img">
                </figure>
                <figure class="gallery__item gallery__item--4">
                    <img src="{{ asset('img/lfc/pack5.png') }}" alt="Gallery image 4" class="gallery__img">
                </figure>
                <figure class="gallery__item gallery__item--5">
                    <img src="{{ asset('img/lfc/pack5.png') }}" alt="Gallery image 5" class="gallery__img">
                </figure>
                <figure class="gallery__item gallery__item--6">
                    <img src="{{ asset('img/lfc/pack5.png') }}" alt="Gallery image 6" class="gallery__img">
                </figure>
            </div>
        </div>
    </div>
</div>
@endsection
