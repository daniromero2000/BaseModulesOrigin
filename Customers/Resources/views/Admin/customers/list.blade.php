@extends('customers::Admin.customers.indexCustomers')
@section('stylesCustomer')
@endsection
@section('contentCustomer')

<section class="content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.customers.index') }}">Clientes</a>
                        </li>

                    </ol>
                </div>
            </div>
        </div>
    </section>

    <list-customers> </list-customers>

</section>
@endsection
@section('scriptsCustomer')
@endsection