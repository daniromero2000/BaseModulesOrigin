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
                                <li class="breadcrumb-item active" aria-current="page">{{ $lead->name }}
                                    {{ $lead->last_name }}
                                </li>
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
                @include('leads::admin.leads.layouts.tracing')
            </div>
            <div class="tab-pane fade" id="gestion" role="tabpanel" aria-labelledby="gestion-tab">
                @include('leads::admin.leads.layouts.management')
            </div>
        </div>

        @include('leads::admin.leads.layouts.add_comment_modal',['data' => $lead])
        @include('leads::admin.leads.layouts.modal_update',['data' => $lead])
        @include('leads::admin.leads.layouts.modal_assigne', ['data' => $lead])
    </section>
@endsection
@section('scripts')
    <script>
        function data(dataId) {
            ontypeServiceSelectedProductEditModal(dataId)
        }

        function ontypeServiceSelectedProductEditModal(dataId) {
            $('#lead_service_id' + dataId).prop("disabled", true);
            $('#lead_product_id' + dataId).prop("disabled", true);
            $('#employee_id' + dataId).prop("disabled", true);

            var typeServiceEditSelected_id = $("#department_id" + dataId).val();
            $.get('/admin/getDeparment/' + typeServiceEditSelected_id + '', function(data) {
                var html_service = '<option selected value> Selecciona </option>';
                let services = data[0].lead_services;
                for (var i = 0; i < services.length; i++) {
                    if ($('#lead_service_id' + dataId).val() == services[i].id) {
                        html_service += '<option value="' + services[i].id + '"  selected="selected">' + services[i]
                            .service + '</option>';
                    }
                    html_service += '<option value="' + services[i].id + '" ">' + services[i].service + '</option>';
                }
                $('#lead_service_id' + dataId).html(html_service);
                $('#lead_service_id' + dataId).prop("disabled", false);

                // Productos
                var html_products = '<option selected value> Selecciona </option>';
                let products = data[0].lead_products;
                for (var i = 0; i < products.length; i++) {
                    if ($('#lead_product_id' + dataId).val() == products[i].id) {
                        html_products += '<option value="' + products[i].id + '"  selected="selected">' + products[
                            i].product + '</option>';
                    }
                    html_products += '<option value="' + products[i].id + '" ">' + products[i].product +
                        '</option>';
                }
                $('#lead_product_id' + dataId).html(html_products);
                $('#lead_product_id' + dataId).prop("disabled", false);

                // Productos
                var html_employees = '<option selected value> Selecciona </option>';
                let employees = data[0].employees;
                for (var i = 0; i < employees.length; i++) {
                    if ($('#employee_id' + dataId).val() == employees[i].id) {
                        html_employees += '<option value="' + employees[i].id + '"  selected="selected">' +
                            employees[i].name + '</option>';
                    }
                    html_employees += '<option value="' + employees[i].id + '" ">' + employees[i].name +
                        '</option>';
                }
                $('#employee_id' + dataId).html(html_employees);
                $('#employee_id' + dataId).prop("disabled", false);
            });
        };

    </script>
    <script>
        function destroy(id) {
            var opcion = confirm("¿Estás seguro de eliminar este registro?");
            if (opcion == true) {
                document.getElementById("form_" + id).submit();
            } else {}
        }
    </script>
@endsection
