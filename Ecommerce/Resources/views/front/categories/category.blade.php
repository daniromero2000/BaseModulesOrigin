@extends('layouts.front.app')
@section('og')
<meta property="og:type" content="category" />
<meta property="og:title" content="{{ $category->name }}" />
<meta property="og:description" content="{{ $category->description }}" />
@if(!is_null($category->cover))
<meta property="og:image" content="{{ asset("storage/$category->cover") }}" />
@endif
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/categories/app.css')}}">
<style>
    /*
    DEMO STYLE
    */

    @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

    p {
        font-family: 'Poppins', sans-serif;
        font-size: 1.1em;
        font-weight: 300;
        line-height: 1.7em;
        color: #999;
    }

    a,
    a:hover,
    a:focus {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s;
    }



    .line {
        width: 100%;
        height: 1px;
        border-bottom: 1px dashed #ddd;
        margin: 40px 0;
    }

    /* ---------------------------------------------------
    SIDEBAR STYLE
    ----------------------------------------------------- */

    #sidebar {
        width: 250px;
        position: fixed;
        top: 0;
        left: -250px;
        height: 100vh;
        z-index: 999;
        background: #002e54;
        color: #fff;
        transition: all 0.3s;
        overflow-y: scroll !important;
        box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
    }

    #sidebar.active {
        left: 0;
    }

    #dismiss {
        width: 35px;
        height: 35px;
        line-height: 35px;
        text-align: center;
        background: #002e54;
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
    }

    #dismiss:hover {
        background: #fff;
        color: #002e54;
    }

    .overlay {
        display: none;
        position: fixed;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.7);
        z-index: 998;
        opacity: 0;
        transition: all 0.5s ease-in-out;
    }

    .overlay.active {
        display: block;
        opacity: 1;
    }

    #sidebar .sidebar-header {
        padding: 20px;
        background: #002e54;
    }

    #sidebar ul.components {
        padding: 20px 0;
        border-bottom: 1px solid #47748b;
    }

    #sidebar ul p {
        color: #fff;
        padding: 10px;
    }

    #sidebar ul li a {
        padding: 10px;
        font-size: 1.1em;
        display: block;
    }

    #sidebar ul li a:hover {
        color: #002e54;
        background: #fff;
    }

    #sidebar ul li.active>a,
    a[aria-expanded="true"] {
        color: #fff;
        background: #002e54;
    }

    a[data-toggle="collapse"] {
        position: relative;
    }

    .dropdown-toggle::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
        background: #002e54;
    }

    ul.CTAs {
        padding: 20px;
    }

    ul.CTAs a {
        text-align: center;
        font-size: 0.9em !important;
        display: block;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    a.download {
        background: #fff;
        color: #002e54;
    }

    a.article,
    a.article:hover {
        background: #002e54 !important;
        color: #fff !important;
    }

    #mCSB_1_container {
        position: initial !important;
        top: 0px;
        left: 0px;
    }

    #sidebarCollapse {
        display: none;
    }

    .sidebar-responsive {
        display: block;
    }

    @media (max-width: 990px) {
        #sidebarCollapse {
            display: block;
        }

        .sidebar-responsive {
            display: none;
        }

        .social {
            z-index: 11;
        }
    }

    ul {
        list-style: none;
        padding-left: 14px;

    }

    input[type=checkbox] {
        color: #fff;
        border-color: #5e72e4;
        background-color: #2743e2;
        box-shadow: 0 3px 2px rgba(233, 236, 239, .05);
    }

    /* ---------------------------------------------------
    CONTENT STYLE
    ----------------------------------------------------- */
    .accordion {
        position: relative;
    }

    .accordion .accordionBtn:before,
    .accordion .accordionBtn.collapsed:before {
        content: "\f067";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        width: 25px;
        height: 25px;
        line-height: 28px;
        font-size: 14px;
        color: #50bbaa;
        text-align: center;
        position: absolute;
        right: 15px;
        transform: rotate(135deg);
        transition: all 0.3s ease 0s;
    }

    .accordion .accordionBtn.collapsed:before {
        color: #a0a0a0;
        transform: rotate(0);
    }
</style>
@endsection
@endsection
@section('content')
<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div id="dismiss">
            <i class="fas fa-arrow-left"></i>
        </div>

        <div class="sidebar-header p-4">
        </div>
        @include('ecommerce::front.categories.sidebar-category')
    </nav>
    <div id="content">
        <div class="w-100">
            <img src="{{ asset('img/fvn/baner-category.png')}}" class="d-block w-100" alt="...">
        </div>
        <div class="tips">
            <img src="{{ asset('img/fvn/tips.png')}}" class="d-block w-100" alt="...">
        </div>
        <div class="container-reset">
            <div class="row mx-auto">
                <div class="col-lg-3">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <button type="button" id="sidebarCollapse" class="btn btn-info">
                                <i class="fas fa-align-left"></i>
                                Categorias
                            </button>
                        </div>
                    </nav>
                    <div class="sidebar-responsive">
                        @include('ecommerce::front.categories.sidebar-category')
                    </div>
                </div>
                <div class="col-md-9 pr-1">
                    @include('ecommerce::front.products.product-list', ['products' => $products])
                </div>
            </div>
        </div>
    </div>
</div>
<div class="overlay"></div>
@endsection

@section('scripts')
<!-- jQuery Custom Scroller CDN -->
<script src="{{ asset('js/front/sidebar/sidebar.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
</script>
@endsection