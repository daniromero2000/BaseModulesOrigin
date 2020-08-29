<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar <b>{{$data->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.employees.update', $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <input name="employee_id" id="employee_id" type="hidden" value="{{ $data->id }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nombre</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" validation-pattern="name"
                                        placeholder="Nombre" class="form-control"
                                        value="{!! $data->name ?: old('name')  !!}" required>
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
                                    <input type="text" name="last_name" id="last_name" validation-pattern="name"
                                        placeholder="Apellido" class="form-control"
                                        value="{!! $data->last_name ?: old('last_name')  !!}" required>
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
                                    <input type="text" name="email" id="email" validation-pattern="email"
                                        placeholder="Email" class="form-control"
                                        value="{!! $data->email ?: old('email')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="cities" class="form-group">
                                <label class="form-control-label" for="employee_position_id">Cargo</label>
                                <div class="input-group">
                                    <select name="employee_position_id" id="employee_position_id" class="form-control">
                                        @foreach($employee_positions as $data_position)
                                        @if($data_position->id == $data->employee_position_id)
                                        <option selected="selected" value="{{ $data_position->id }}">
                                            {{ $data_position->position }}</option>
                                        @else
                                        <option value="{{ $data_position->id }}">{{ $data_position->position }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="cities" class="form-group">
                                <label class="form-control-label" for="department_id">Departamento</label>
                                <div class="input-group">
                                    <select name="department_id" id="department_id" class="form-control">
                                        @foreach($all_departments as $department)
                                        @if($department->id == $data->department_id)
                                        <option selected="selected" value="{{ $department->id }}">
                                            {{ $department->name }}
                                        </option>
                                        @else
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" id="password" placeholder="xxxxx"
                                        class="form-control" value="{!! $data->phone ?: old('phone')  !!}">
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
                                    <input type="text" name="rh" id="rh" placeholder="RH" class="form-control"
                                        value="{!! $data->rh ?: old('rh')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email">Cuenta Bancaria</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-drop"></i></span>
                                    </div>
                                    <input type="text" name="bank_account" id="bank_account" placeholder="XXXX"
                                        class="form-control" value="{!! $data->bank_account ?: old('bank_account')  !!}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email">Turno</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-drop"></i></span>
                                    </div>
                                    <input type="text" name="work_schedule" id="work_schedule" placeholder="Horario"
                                        class="form-control"
                                        value="{!! $data->work_schedule ?: old('work_schedule')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email">Ingreso</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-drop"></i></span>
                                    </div>
                                    <input type="date" name="admission_date" id="admission_date"
                                        placeholder="Fecha Ingreso" class="form-control"
                                        value="{!! $data->admission_date ?: old('admission_date')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="is_rotative" class="form-group">
                                <label class="form-control-label" for="is_rotative">Rota?</label>
                                <div class="input-group">
                                    <select name="is_rotative" id="is_rotative" class="form-control">
                                        @if( 1 == $data->is_rotative)
                                        <option selected="selected" value="1">Sí </option>
                                        <option value="0">No</option>
                                        @elseif( 0 == $data->is_rotative)
                                        <option selected="selected" value="0">No</option>
                                        <option value="1">Sí</option>
                                        @else
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            @include('generals::admin.shared.status-select', ['status' => $data->is_active])
                        </div>
                        <div class="col-sm-6">
                            <label class="form-control-label" for="password">Rol</label>
                            @include('generals::admin.shared.roles', ['roles' => $roles, 'selectedIds' =>
                            $data->roles()->pluck('role_id')->all()])
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
