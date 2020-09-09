<!-- Phones -->
<div class="col-md-6">
  <div class="card">
    <div class="card-body">
      <div class="row align-items-center mb-3">
        <div class="col">
          <h3 class="mb-0">Datos de Eps</h3>
        </div>
        <div class="col text-right">
          <a href="# " data-toggle="modal" data-target="#epsmodal" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
            Agregar Eps</a>
        </div>
      </div>
      <div class="w-100">
        <div class="table-responsive">
          @if($employee->employeeEpss->isNotEmpty())

          <table class="table align-items-center table-flush table-hover text-center">
            <thead class="thead-light">
              <tr>
                <th class="text-center" scope="col">Fecha Registro</th>
                <th class="text-center" scope="col">Eps</th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach ($employee->employeeIdentities as $employee_identity)
              @include('generals::layouts.admin.tables.customer_eps_noheaders_table', ['datas' => $employee->employeeEpss])

              @endforeach
            </tbody>
          </table>
          @else
          <span class="text-sm">Aún no tiene Eps</span>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>