<!-- Phones -->
<div class="col-md-6">
  <div class="card">
    <div class="card-body">
      <div class="row align-items-center mb-3">
        <div class="col">
          <h3 class="mb-0">Teléfonos</h3>
        </div>
        <div class="col text-right">
          <a href="# " data-toggle="modal" data-target="#phonemodal" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
            Agregar Teléfono</a>
        </div>
      </div>
      <div class="w-100">
        <div class="table-responsive">
          @if($employee->employeePhones->isNotEmpty())
          <table class="table align-items-center table-flush table-hover text-center">
            <thead class="thead-light">
              <tr>
                <th class="text-center" scope="col">Tipo Teléfono</th>
                <th class="text-center" scope="col">Teléfono</th>
                <th class="text-center" scope="col">Fecha Registro</th>
              </tr>
            </thead>
            <tbody class="list">
              @include('generals::layouts.admin.tables.noheaders_table', ['datas' => $employee->employeePhones])

            </tbody>
          </table>
          @else
          <span class="text-sm">Aún no tiene Teléfonos</span>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>