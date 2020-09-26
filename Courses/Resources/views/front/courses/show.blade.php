@extends('layouts.front.app')
@section('styles')
<style>
    @media screen and (min-width: 1601px) {
        .padding-x {
            padding: 7px 5% !important;
        }

        .tittle-principal {
            font-size: 2.7rem !important;
        }

        .tittle-secondary {
            font-size: 4.2rem !important;
        }

        .button-img {
            max-width: 36% !important;
        }
    }

    @media screen and (min-width: 1400px) and (max-width: 1600px) {
        .padding-x {
            padding: 7px 5% !important;
        }

        .tittle-principal {
            font-size: 2.2rem !important;
        }

        .tittle-secondary {
            font-size: 3.4rem !important;
        }

        .button-img {
            max-width: 36% !important;
        }
    }

    .button-img {
        max-width: 32%;
    }

    .padding-x {
        padding: 10px 3%;
    }

    .margin-top {
        margin: 5% 0%;
    }

    .tittle-principal {
        font-size: 1.8rem;
        margin-bottom: 0px;
        color: #036db1;
        font-weight: 400;
    }

    .tittle-secondary {
        font-size: 2.8rem;
        color: #00a9eb;
    }

    @media screen and (min-width: 750px) and (max-width: 990px) {
        .padding-x {
            padding: 7px 3%;
        }

        .tittle-principal {
            font-size: 1.1rem;
        }

        .tittle-secondary {
            font-size: 1.8rem;
        }

        .button-img {
            max-width: 35%;
        }
    }

    @media screen and (min-width: 550px) and (max-width: 750px) {
        .padding-x {
            padding: 5px 2%;
        }

        .tittle-principal {
            font-size: 1rem;
            margin-top: 10px;
        }

        .tittle-secondary {
            font-size: 1.5rem;
        }

        .button-img {
            max-width: 39%;
        }
    }

    @media screen and (min-width: 420px) and (max-width: 550px) {
        .padding-x {
            padding: 5px 3%;
        }

        .tittle-principal {
            font-size: 0.7rem;
            margin-top: 10px;
        }

        .tittle-secondary {
            font-size: 1.1rem;
        }

        .button-img {
            max-width: 45%;
        }
    }

    @media screen and (min-width: 300px) and (max-width: 420px) {
        .padding-x {
            padding: 5px 3%;
        }

        .tittle-principal {
            font-size: 0.8rem;
            margin-top: 10px;
        }

        .tittle-secondary {
            font-size: 1.3rem;
        }

        .button-img {
            max-width: 42%;
        }
    }
</style>
@endsection
@section('content')
<section class="header">
    <div class="w-100">
        <img src="{{asset("storage/$course->img_welcome")}}" class="img-fluid" alt="">
    </div>
</section>

<section>
    <div class="w-100 padding-x">
        <h2 class="tittle-principal">Verifica tus horarios y cada vez que tengas clase
        </h2>
        <h1 class="tittle-secondary">Ingresa aqui para acceder al salón</h1>
    </div>
    <div class="w-100 padding-x">
        <a href="{{$course->link}}">
            <img src="{{asset("storage/$course->img_button")}}" class="img-fluid button-img" alt="">
        </a>
    </div>

    <div class="w-100 padding-x">
        <img src="{{asset("storage/$course->img_footer")}}" class="img-fluid" alt="">
    </div>
</section>

@endsection