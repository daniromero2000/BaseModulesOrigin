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
                                <li class="breadcrumb-item " active aria-current="page">Empleados</li>
                                <li class="breadcrumb-item active">Crear Empleado</li>
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
        <div class="card">
            <form action="{{ route('admin.employees.store') }}" method="post" class="form">
                <div class="card-body">
                    @csrf
                    <div class="col pl-0 mb-3">
                        <h2>Crear Empleado</h2>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nombre</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input required type="text" name="name" id="name" validation-pattern="name"
                                        placeholder="Nombre" class="form-control" value="{!!  old('name') !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="last_name">Apellido</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input required type="text" name="last_name" id="last_name" validation-pattern="name"
                                        placeholder="Apellido" class="form-control" value="{!!  old('last_name') !!}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email">Email</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <input required type="text" name="email" id="email" validation-pattern="email"
                                        placeholder="Email" class="form-control" value="{!!  old('email') !!}" required>
                                </div>
                            </div>
                        </div>

                        @if (auth()
            ->guard('employee')
            ->user()->role[0]->id == 1)
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="company_id">Empresa</label>
                                    <div class="input-group">
                                        <select required name="company_id" id="company_id" class="form-control" enabled>
                                            <option value="" selected>Selecciona</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="subsidiaries" class="form-group">
                                    <label class="form-control-label" for="subsidiary_id">Sucursal</label>
                                    <div class="input-group">
                                        <select required name="subsidiary_id" disabled id="subsidiary_id" class="form-control"
                                            enabled>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="cities" class="form-group">
                                    <label class="form-control-label" for="employee_position_id">Cargo</label>
                                    <div class="input-group">
                                        <select required name="employee_position_id" disabled id="employee_position_id"
                                            class="form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="cities" class="form-group">
                                    <label class="form-control-label" for="department_id">Departamento</label>
                                    <div class="input-group">
                                        <select required name="department_id" disabled id="department_id" class="form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-sm-6">
                                <div id="subsidiaries" class="form-group">
                                    <label class="form-control-label" for="subsidiary_id">Sucursal</label>
                                    <div class="input-group">
                                        <select required name="subsidiary_id" id="subsidiary_id" class="form-control" enabled>
                                            @foreach ($subsidiaries as $subsidiary)
                                                <option value="{{ $subsidiary->id }}">{{ $subsidiary->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="cities" class="form-group">
                                    <label class="form-control-label" for="employee_position_id">Cargo</label>
                                    <div class="input-group">
                                        <select required name="employee_position_id" id="employee_position_id" class="form-control">
                                            @foreach ($employee_positions as $data_position)
                                                <option value="{{ $data_position->id }}">{{ $data_position->position }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div id="cities" class="form-group">
                                    <label class="form-control-label" for="department_id">Departamento</label>
                                    <div class="input-group">
                                        <select required name="department_id" id="department_id" class="form-control">
                                            @foreach ($all_departments as $department)
                                                <option value="{{ $department->id }}"> {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="password">Contraseña</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    </div>
                                    <input required type="password" name="password" id="password" placeholder="xxxxx"
                                        class="form-control" value="{!!  old('password') !!}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email">Tipo Sangre</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-drop"></i></span>
                                    </div>
                                    <input required type="text" name="rh" id="rh" placeholder="RH" class="form-control"
                                        value="{!!  old('rh') !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="birthday">Fecha Nacimiento</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-drop"></i></span>
                                    </div>
                                    <input required type="date" name="birthday" id="birthday" placeholder="Fecha Nacimiento"
                                        class="form-control" value="{!!  old('birthday') !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            @include('generals::admin.shared.status-select', ['status' => '0'])
                        </div>
                        <div class="col-sm-6 mt-3">
                            <label class="form-control-label" for="password">Rol</label>
                            <div class="row mx-0">
                                @foreach ($roles as $role)
                                    <div class="px-2">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="role{{ $role->id }}" type="checkbox"
                                                name="roles[]" value="{{ $role->id }}">
                                            <label class="custom-control-label"
                                                for="role{{ $role->id }}">{{ $role->display_name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                    <a href="{{ route('admin.companies.index') }}" class="btn btn-default btn-sm">Regresar</a>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#company_id").change(function() {
                $('#subsidiary_id').prop("disabled", false);
                $('#department_id').prop("disabled", false);
                $('#employee_position_id').prop("disabled", false);

                $.get('/admin/subsidiaries/company/' + $(this).val(), function(data) {
                    var html_insert =
                        '<option data-select3-id=""  selected value>  Selecciona  </option>'
                    for (var i = 0; i < data.length; i++) {
                        html_insert += '<option value="' + data[i].id + '">' + data[i].name +
                            '</option>';
                    }
                    $('#subsidiary_id').html(html_insert);
                    $('#subsidiary_id').prop("disabled", false);
                });

                $.get('/admin/companies/getDepartments/' + $(this).val(), function(data) {
                    var html_deparments =
                        '<option data-select3-id=""  selected value>  Selecciona  </option>'
                    var html_employee_positions =
                        '<option data-select3-id=""  selected value>  Selecciona  </option>'
                    for (var i = 0; i < data.length; i++) {
                        html_deparments += '<option value="' + data[i].id + '">' + data[i].name +
                            '</option>';

                        if (data[i].employee_positions) {
                            data[i].employee_positions.forEach(element => {
                                html_employee_positions += '<option value="' + element.id +
                                    '">' + element.position + '</option>';
                            });
                        }
                    }

                    $('#department_id').html(html_deparments);
                    $('#department_id').prop("disabled", false);

                    $('#employee_position_id').html(html_employee_positions);
                    $('#employee_position_id').prop("disabled", false);
                });
            });
        });

    </script>

@endsection
