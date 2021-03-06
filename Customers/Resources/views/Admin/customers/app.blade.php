@extends('generals::layouts.admin.app')
@section('styles')
<script src="{{ asset('js/customers.js') }}" defer></script>
<style>
    .card-img-overlay {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 1.25rem;
    }

    .modal-dialog .overlay {
        background-color: #000;
        display: block;
        height: 100%;
        left: 0;
        opacity: .7;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 1052;
    }

    .card>.overlay,
    .card>.loading-img,
    .overlay-wrapper>.overlay,
    .overlay-wrapper>.loading-img,
    .info-box>.overlay,
    .info-box>.loading-img,
    .small-box>.overlay,
    .small-box>.loading-img {
        height: 100%;
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
    }

    .card .overlay,
    .overlay-wrapper .overlay,
    .info-box .overlay,
    .small-box .overlay {
        border-radius: 0.25rem;
        -ms-flex-align: center;
        align-items: center;
        background: rgba(255, 255, 255, 0.2);
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: center;
        justify-content: center;
        z-index: 50;
    }

    .card .overlay>.fa,
    .card .overlay>.fas,
    .card .overlay>.far,
    .card .overlay>.fab,
    .card .overlay>.glyphicon,
    .card .overlay>.ion,
    .overlay-wrapper .overlay>.fa,
    .overlay-wrapper .overlay>.fas,
    .overlay-wrapper .overlay>.far,
    .overlay-wrapper .overlay>.fab,
    .overlay-wrapper .overlay>.glyphicon,
    .overlay-wrapper .overlay>.ion,
    .info-box .overlay>.fa,
    .info-box .overlay>.fas,
    .info-box .overlay>.far,
    .info-box .overlay>.fab,
    .info-box .overlay>.glyphicon,
    .info-box .overlay>.ion,
    .small-box .overlay>.fa,
    .small-box .overlay>.fas,
    .small-box .overlay>.far,
    .small-box .overlay>.fab,
    .small-box .overlay>.glyphicon,
    .small-box .overlay>.ion {
        color: #343a40;
    }

    .card .overlay.dark,
    .overlay-wrapper .overlay.dark,
    .info-box .overlay.dark,
    .small-box .overlay.dark {
        background: rgba(0, 0, 0, 0.3);
    }

    .card .overlay.dark>.fa,
    .card .overlay.dark>.fas,
    .card .overlay.dark>.far,
    .card .overlay.dark>.fab,
    .card .overlay.dark>.glyphicon,
    .card .overlay.dark>.ion,
    .overlay-wrapper .overlay.dark>.fa,
    .overlay-wrapper .overlay.dark>.fas,
    .overlay-wrapper .overlay.dark>.far,
    .overlay-wrapper .overlay.dark>.fab,
    .overlay-wrapper .overlay.dark>.glyphicon,
    .overlay-wrapper .overlay.dark>.ion,
    .info-box .overlay.dark>.fa,
    .info-box .overlay.dark>.fas,
    .info-box .overlay.dark>.far,
    .info-box .overlay.dark>.fab,
    .info-box .overlay.dark>.glyphicon,
    .info-box .overlay.dark>.ion,
    .small-box .overlay.dark>.fa,
    .small-box .overlay.dark>.fas,
    .small-box .overlay.dark>.far,
    .small-box .overlay.dark>.fab,
    .small-box .overlay.dark>.glyphicon,
    .small-box .overlay.dark>.ion {
        color: #ced4da;
    }

    @-webkit-keyframes spinner-border {
        to {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes spinner-border {
        to {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    .spinner-border {
        display: inline-block;
        width: 2rem;
        height: 2rem;
        vertical-align: text-bottom;
        border: 0.25em solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        -webkit-animation: spinner-border .75s linear infinite;
        animation: spinner-border .75s linear infinite;
    }

    .spinner-border-sm {
        width: 1rem;
        height: 1rem;
        border-width: 0.2em;
    }

    @-webkit-keyframes spinner-grow {
        0% {
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        50% {
            opacity: 1;
        }
    }

    @keyframes spinner-grow {
        0% {
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        50% {
            opacity: 1;
        }
    }

    .spinner-grow {
        display: inline-block;
        width: 2rem;
        height: 2rem;
        vertical-align: text-bottom;
        background-color: currentColor;
        border-radius: 50%;
        opacity: 0;
        -webkit-animation: spinner-grow .75s linear infinite;
        animation: spinner-grow .75s linear infinite;
    }

    .spinner-grow-sm {
        width: 1rem;
        height: 1rem;
    }

    .b-overlay .bg-light {
        background-color: #eaf2f9 !important;
    }

    .spinner-border {
        color: #5e72e4 !important
    }

</style>
@yield('stylesCustomer')
@endsection
@section('header')
@yield('headerCustomer')
@endsection
@section('content')
<section id="customersAdmin">
    @yield('contentCustomer')
</section>
@endsection
@section('scripts')
@yield('scriptsCustomer')
@endsection