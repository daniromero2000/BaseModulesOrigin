@php
$fechaActual = strtotime(date("Y-m-d"));
$fechaMayorEdad = date("Y-m-d", strtotime("-18 years", $fechaActual));
@endphp
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
                            <li class="breadcrumb-item"><a href="{{ route('admin.leads.index') }}">Leads</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{$lead->name}}
                                {{$lead->last_name}}</li>
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

    <div class="nav-wrapper">
        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-sm-3 mb-md-0 active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                    aria-controls="home" aria-selected="true">Lead</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-sm-3 mb-md-0" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Seguimiento</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link mb-sm-3 mb-md-0" id="gestion-tab" data-toggle="tab" href="#gestion" role="tab"
                    aria-controls="gestion" aria-selected="false">Indicadores de gestión</a>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            @include('leads::admin.leads.layouts.generals',['data' => $lead])
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center mb-3">
                                <div class="col">
                                    <h3 class="mb-0">Comentarios</h3>
                                </div>
                                <div class="col text-right">
                                    <a data-toggle="modal" data-target="#commentmodal{{ $lead->id }}" href=""
                                        class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                                        Agregar Comentario</a>
                                </div>
                            </div>
                            <div class="w-100">
                                <div class="table-responsive">
                                    @if($lead->leadComments->isNotEmpty())
                                    <table class="table align-items-center table-flush table-hover text-center">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center" scope="col">Comentario</th>
                                                <th class="text-center" scope="col">Usuario</th>
                                                <th class="text-center" scope="col">Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach($lead->leadComments as $data)
                                            <tr>
                                                @if(!empty($data))
                                                <td class="text-center">
                                                    {{ $data->comment }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $data->employee->name}}
                                                </td>
                                                <td class="text-center">
                                                    {{ $data->created_at}}
                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        <tbody>
                                    </table>
                                    @else
                                    <span class="text-sm">Aún no tiene comentarios</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('leads::admin.leads.layouts.statusesLog', ['datas' => $lead->leadStatusesLogs])
            </div>
        </div>
        <div class="tab-pane fade" id="gestion" role="tabpanel" aria-labelledby="gestion-tab">
            <div class="row">
                {{-- @include('generals::layouts.admin.commentaries', ['datas' => $lead->leadComments]) --}}
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <h3 class="mb-0">Historial</h3>
                        </div>

                        @if(!Empty($lead->leadManagementStatus))
                        <div class="card-body" style=" max-height: 500px; overflow: auto; ">
                            @foreach($lead->leadManagementStatus as $data)

                            <div class="timeline timeline-one-side" data-timeline-content="axis"
                                data-timeline-axis-style="dashed">
                                <div class="timeline-block">
                                    <span class="timeline-step"
                                        style="color: {{$data->status->color}}; background:{{ $data->status->background}}">
                                        <i class="fa fa-clock"></i>
                                    </span>
                                    <div class="timeline-content">
                                        <small
                                            class="text-muted font-weight-bold">{{$data->created_at->format('M d, Y h:i a')}}</small>
                                        <h5 class=" mt-3 mb-0"><span class="badge"
                                                style="color: {{$data->status->color}}; background:{{ $data->status->background}}">{{ $data->status->status}}</span>
                                        </h5>
                                        <p class=" text-sm mt-1 mb-0"><b>Usuario:</b> {{$data->user->name}}</p>
                                        <div class="mt-3 mb-3">
                                            <span class="badge badge-pill "
                                                style="color: {{$data->status->color}}; background:{{ $data->status->background}}">
                                                {{$lead->created_at->diffForHumans($data->created_at)}} de ser
                                                creado</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endforeach

                        </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
        {{-- <div class="row">
            <a href="{{ route('admin.employees.index') }}" class="btn btn-default btn-sm">Regresar</a>
    </div> --}}
    </div>

    @include('leads::admin.leads.layouts.add_comment_modal',['data' => $lead])
    @include('leads::admin.leads.layouts.modal_update',['data' => $lead])
</section>
@endsection