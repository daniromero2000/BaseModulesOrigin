<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0">{{ $employee->employeePosition->position }} {{ $employee->name }} {{ $employee->last_name }}</h3>
            </div>
            <div class="col text-right">
                <a data-toggle="modal" data-target="#modal{{ $employee->id }}"
                    class="btn btn-primary text-white btn-sm"><i class="fa fa-edit"></i> Editar</a>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                <table class="table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Email Usuario</th>
                            <th scope="col">Sucursal</th>
                            <th scope="col">RH</th>
                            <th scope="col">Cuenta Bancaria</th>
                            <th scope="col">Roles</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->subsidiary->name }}</td>
                            <td>{{ $employee->rh }}</td>
                            <td>{{ $employee->bank_account }}</td>
                            <td>
                                {{ $employee->roles()->get()->implode('display_name', ', ') }}
                            </td>
                        </tr>
                    </tbody>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Turno</th>
                            <th scope="col">Rota?</th>
                            <th scope="col">Inicio Labores</th>
                            <th scope="col">Última Sesión</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td>{{ $employee->work_schecule }}</td>
                            <td> @if ($employee->work_schecule == 0) No @endif @if ($employee->work_schecule == 1) Si
                                @endif</td>
                            <td>{{ $employee->admission_date }}</td>
                            <td>{{ $employee->last_login_at }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row mt-3 mx-0">
                    <div class="col text-right">
                        <form action="{{ route('admin.employees.destroy', $employee['id']) }}" method="post"
                            class="form-horizontal">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <div class="btn-group">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
