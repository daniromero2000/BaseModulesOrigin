@extends('generals::layouts.admin.app')
@section('styles')
    <script src="{{ asset('js/callcenter.js') }}" defer></script>
@endsection
@section('header')
    <div class="header pb-2">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" active aria-current="page">Crear Questionario</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <section class="content">
        <div id="callCenter">
            <app-show :id="{{$id}}"></app-show>
        </div>
    </section>
@endsection
@section('scripts')
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
