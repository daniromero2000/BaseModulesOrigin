<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center mb-3">
                    <div class="col">
                        <h3 class="mb-0">Comentarios</h3>
                    </div>
                    <div class="col text-right">
                        <a data-toggle="modal" data-target="#commentmodal{{ $lead->id }}" href=""
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                            Agregar Comentario</a>
                    </div>
                </div>
                <div class="w-100">
                    <div class="table-responsive">
                        @if ($lead->leadComments->isNotEmpty())
                            <table class="table align-items-center table-flush table-hover text-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col">Comentario</th>
                                        <th class="text-center" scope="col">Usuario</th>
                                        <th class="text-center" scope="col">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($lead->leadComments as $data)
                                        <tr>
                                            @if (!empty($data))
                                                <td class="text-center">
                                                    {{ $data->comment }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $data->employee->name }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $data->created_at }}
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                <tbody>
                            </table>
                        @else
                            <span class="text-sm">Aún no tiene comentarios</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('leads::admin.leads.layouts.statusesLog', ['datas' => $lead->leadStatusesLogs])
</div>
