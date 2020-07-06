<div class="card">
  <div class="card-body">
    <div class="row align-items-center mb-3">
      <div class="col">
        <h3 class="mb-0">{{ $employee->name }} {{ $employee->last_name }}</h3>
      </div>
      <div class="col text-right">
        <a href="{{ route('admin.employees.edit', $employee['id']) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Editar</a>
      </div>
    </div>
    <div class="w-100">
      <div class="table-responsive">

        <table class="table align-items-center table-flush table-hover text-center">
          <thead class="thead-light">
            <tr>
              <th scope="col">Email Usuario</th>
              <th scope="col">Cargo</th>
              <th scope="col">Sucursal</th>
              <th scope="col">Roles</th>
            </tr>
          </thead>
          <tbody class="list">
            <tr>
              <td>{{ $employee->email }}</td>
              <td>{{ $employee->employeePosition->position }}</td>
              @foreach ($employee->department as $department )
              <td>{{ $department->subsidiary->name}}</td>
              @endforeach
              <td>
                {{ $employee->roles()->get()->implode('name', ', ') }}
              </td>
            </tr>
          </tbody>
        </table>
        <div class="row mt-3 mx-0">
          <div class="col text-right">
            <form action="{{ route('admin.employees.destroy', $employee['id']) }}" method="post" class="form-horizontal">
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