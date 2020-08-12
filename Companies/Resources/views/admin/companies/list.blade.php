@extends('generals::layouts.admin.app')
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" active aria-current="page">Compañias</li>
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
    @include('generals::layouts.errors-and-messages')
    @if(!$companies->isEmpty())
    <div class="card">
        <div class="card-header border-0">
            <h3 class="mb-0">Compañias</h3>
        </div>
        @php
        @endphp
        @include('generals::layouts.admin.tables.tables', [$headers, 'datas' => $companies ])
        <div class="card-footer py-2">
        </div>
    </div>
    @else
    @endif
</section>
@endsection