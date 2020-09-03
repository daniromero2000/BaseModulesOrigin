{{-- <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <nav class="navbar navbar-static-top"> <a href="#" class="sidebar-toggle" data-toggle="push-menu"
                    role="button">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span>
                    <span class="icon-bar"></span> </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img
                                    src="{{ asset('img/avatarsocomir.png') }}" class="user-image" alt="User Image">
<span class="hidden-xs"></span> </a>
<ul class="dropdown-menu">
    <li class="user-header"> <img src="{{ asset('img/avatarsocomir.png') }}" class="img-circle" alt="User Image">
        <p> <small>Miembro desde
            </small></p>
    </li>
    <li class="user-body"></li>
    <li class="user-footer">
        <div class="pull-left"> <a href="{{ route('admin.employee.profile', 1) }}"
                class="btn btn-default btn-flat">Perfil</a></div>
        <div class="pull-right"> <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Salir</a></div>
    </li>
</ul>
</li>
</ul>
</div>
</nav>
</li>
</ul>
</nav> --}}
<!-- /.navbar -->

{{-- {{ $user->name }} {{ date('m Y', strtotime($user->created_at)) }} --}}


<!-- Topnav -->
<nav class="navbar navbar-top navbar-expand navbar-light bg-secondary border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Search form -->
            {{-- <form class="navbar-search navbar-search-dark form-inline mr-sm-3" id="navbar-search-main">
                <div class="form-group mb-0">
                    <div class="input-group input-group-alternative input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" placeholder="Search" type="text">
                    </div>
                </div>
                <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main"
                    aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </form> --}}
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-pin"
                        data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                        <i class="ni ni-zoom-split-in"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="ni ni-bell-55"></i>
                    </a>

                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="ni ni-ungroup"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default dropdown-menu-right">
                        <div class="row shortcuts px-4">
                            <a href="{{ route('admin.customers.index')}}" class="col-4 shortcut-item">
                                <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                                    <i class="ni ni-user"></i>
                                </span>
                                <small>Clientes</small>
                            </a>
                            <a href="{{ route('admin.orders.index')}}" class="col-4 shortcut-item">
                                <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                    <i class="ni ni-credit-card"></i>
                                </span>
                                <small>Ordenes</small>
                            </a>
                            <a href="{{ route('admin.checkouts.index')}}" class="col-4 shortcut-item">
                                <span class="shortcut-media avatar rounded-circle bg-gradient-green">
                                    <i class="ni ni-books"></i>
                                </span>
                                <small>Checkouts</small>
                            </a>
                            <a href="{{ route('admin.products.index')}}" class="col-4 shortcut-item">
                                <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                                    <i class="ni ni-basket"></i>
                                </span>
                                <small>Productos</small>
                            </a>
                            <a href="{{ route('admin.wishlists.index')}}" class="col-4 shortcut-item">
                                <span class="shortcut-media avatar rounded-circle bg-gradient-yellow">
                                    <i class="fas fa-heart"></i>
                                </span>
                                <small>Wishlist</small>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle" style=" background-color: white; ">
                                <img alt="Image placeholder"
                                    src="{{asset('modules/generals/argonTemplate/img/theme/user.png')}}">
                            </span>
                            <div class=" media-body ml-2 d-none d-lg-block">
                                <span
                                    class="mb-0 text-sm  font-weight-bold">{{auth()->guard('employee')->user()->name}}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Bienvenido!</h6>
                        </div>
                        <a href="/admin/employees/{{auth()->guard('employee')->user()->id}}/profile"
                            class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>Mi perfil</span>
                        </a>
                        {{-- <a href="#!" class="dropdown-item">
                            <i class="ni ni-settings-gear-65"></i>
                            <span>Settings</span>
                        </a>
                        <a href="#!" class="dropdown-item">
                            <i class="ni ni-calendar-grid-58"></i>
                            <span>Activity</span>
                        </a>
                        <a href="#!" class="dropdown-item">
                            <i class="ni ni-support-16"></i>
                            <span>Support</span>
                        </a> --}}
                        <div class="dropdown-divider"></div>
                        <a href="/admin/logout" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Salir</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Header -->
