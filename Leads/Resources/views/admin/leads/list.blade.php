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
                            <li class="breadcrumb-item active" active aria-current="page">Leads</li>
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
    @if(!$leads->isEmpty())
    <div class="card">
        <div class="card-header border-0">
            <h3 class="mb-0">Leads</h3>
            @include('leads::admin.leads.layouts.search', ['route' => route('admin.leads.index')])
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        @foreach ($headers as $header)
                        <th class="text-center">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($leads as $data)
                    <tr>
                        <td> {{$data->identification_number}} </td>
                        <td> {{$data->name}} </td>
                        <td> {{$data->last_name}} </td>
                        <td> {{$data->email}} </td>
                        <td> {{$data->telephone}} </td>
                        <td> {{$data->department->name}} </td>
                        <td> {{$data->created_at}} </td>
                        <td> <span class="badge"
                                style="color:{{$data->leadStatuses->color}}; background:{{$data->leadStatuses->background}} ">{{$data->leadStatuses->status}}</span>
                        </td>
                        <td>
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    @include('leads::admin.leads.layouts.modal_update')
                    @include('leads::admin.leads.layouts.add_comment_modal')
                    @include('leads::admin.leads.layouts.modal_assigne')
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
        @else
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination_null', [$skip, $optionsRoutes])
        </div>
    </div>
    @endif
</section>
@endsection

@section('scripts')
<script>
    function dataLead(dataId) {
    ontypeServiceSelectedProductEditModal(dataId)
    }
       
    function ontypeServiceSelectedProductEditModal(dataId) {
        $('#lead_service_id' + dataId).prop("disabled", true);
        $('#lead_product_id' + dataId).prop("disabled", true);
        $('#employee_id' + dataId).prop("disabled", true);

    var typeServiceEditSelected_id = $("#department_id" + dataId).val();
    $.get('/admin/getDeparment/' + typeServiceEditSelected_id + '', function (data) {
        var html_service = '<option selected value> Selecciona </option>';
        let services = data[0].lead_services;
        console.log(data[0].lead_services)
        for (var i = 0; i <services.length; i++) {
            if ($('#lead_service_id' + dataId).val() == services[i].id) {
                html_service += '<option value="' +services[i].id + '"  selected="selected">' + services[i].service + '</option>';
            }
            html_service += '<option value="' +services[i].id + '" ">' +services[i].service + '</option>';
        }
        $('#lead_service_id' + dataId).html(html_service);
        $('#lead_service_id' + dataId).prop("disabled", false);

    // Productos
        var html_products = '<option selected value> Selecciona </option>';
            let products = data[0].lead_products;
            console.log(data[0].lead_products)
            for (var i = 0; i <products.length; i++) {
                if ($('#lead_product_id' + dataId).val() == products[i].id) {
                    html_products += '<option value="' +products[i].id + '"  selected="selected">' + products[i].product + '</option>';
                }
                html_products += '<option value="' +products[i].id + '" ">' +products[i].product + '</option>';
            }
        $('#lead_product_id' + dataId).html(html_products);
        $('#lead_product_id' + dataId).prop("disabled", false);

         // Productos
        var html_employees = '<option selected value> Selecciona </option>';
            let employees = data[0].employees;
            console.log(data[0].employees)
            for (var i = 0; i < employees.length; i++) {
                if ($('#employee_id' + dataId).val() == employees[i].id) {
                    html_employees += '<option value="' +employees[i].id + '"  selected="selected">' + employees[i].name + '</option>';
                }
                html_employees += '<option value="' +employees[i].id + '" ">' +employees[i].name + '</option>';
            }
        $('#employee_id' + dataId).html(html_employees);
        $('#employee_id' + dataId).prop("disabled", false);
    });


};

</script>

@endsection