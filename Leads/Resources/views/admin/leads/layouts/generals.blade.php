<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">

                <h3 class="mb-0"> {{ $data->name }}
                    {{ $data->last_name }}</h3>
            </div>
            <div class="col text-right">
                <a data-toggle="modal" data-target="#modal{{ $data->id }}" class="btn btn-primary text-white btn-sm"><i
                        class="fa fa-edit"></i> Editar</a>
            </div>
        </div>

        <div class="card-body">
            <h6 class="heading-small text-muted mb-4">Informacion</h6>
            <div class="pl-lg-3">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Cedúla</th>
                                <th scope="col">Email</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Canal</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <td>{{ $data->identification_number }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->telephone }}</td>
                                <td>{{ $data->city->city }}</td>
                                <td>{{ $data->leadChannel->channel }}</td>
                                                   <td> <span class="badge"
                                style="color:{{ $data->leadStatuses ? $data->leadStatuses->color : ''}}; background:{{ $data->leadStatuses ? $data->leadStatuses->background : ''}} ">{{$data->leadStatuses ? $data->leadStatuses->status : 'Sin estado'}}</span>
                        </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr class="my-4">
            <!-- Address -->
            <h6 class="heading-small text-muted mb-4"></h6>
            <div class="pl-lg-3">
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Producto</th>
                                <th scope="col">Servicio</th>
                                @if ($data->leadInformation)
                                <th scope="col">Tipo de persona</th>
                                <th scope="col">Entidad</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Plazo</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <td>{{ $data->leadProduct->product }}</td>
                                <td>{{ $data->leadService->service }}</td>
                                @if ($data->leadInformation)
                                <td>{{ $data->leadInformation->kind_of_person }}</td>
                                <td>{{ $data->leadInformation->entity }}</td>
                                <td> ${{ number_format($data->leadInformation->amount) }}</td>
                                <td>{{ $data->leadInformation->term }}</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="w-100">

        </div>
    </div>
</div>