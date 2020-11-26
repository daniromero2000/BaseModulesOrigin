<div class="modal fade" id="modal-assigne{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Asignar Lead <b>{{$data->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($routeEdit, $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        @foreach ($inputsAssigne as $input)
                        @if($input['type'] == 'text' || $input['type'] == 'number' || $input['type']
                        ==
                        'date' || $input['type'] == 'time' || $input['type'] == 'url')
                        <div class="col-sm-6 col-12 form-group">
                            <label for="{{ $input['name'].$data->id }}">{{ $input['label'] }}</label>
                            <input type="{{ $input['type'] }}" id="{{ $input['name'].$data->id }}"
                                value="{{ (array_key_exists($input['name'], $data->getOriginal())) ? $data->getOriginal()[$input['name']] : '' }}"
                                name='{{ $input['name'] }}' step="any" class="form-control">
                        </div>
                        @elseif($input['type'] == 'select')
                        <div class="col-sm-6 col-12 form-group">
                            <label for="{{ $input['name'].$data->id }}">{{ $input['label'] }}</label>
                            <select class="form-control" name="{{ $input['name'] }}"
                                {{ array_key_exists('disabled', $input) ? 'disabled=""' : ''}}
                                id="{{ $input['name'].$data->id }}" {{ $input['name'] == 'department_id' ? 'onchange='."ontypeServiceSelectedProductEditModal($data->id)"
                                : '' }}>
                                @foreach ($input['options'] as $option)
                                <option @if($data->getOriginal()[$input['name']] == $option['id'])
                                    selected='selected' @endif
                                    value="{{ $option['id'] }}">{{ $option[$input['option']] }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @elseif($input['type'] == 'textarea')
                        <div class="col-12 form-group">
                            <label for="{{ $input['name'].$data->id }}">{{ $input['label'] }}</label>
                            <textarea class="form-control" name="{{ $input['name'] }}"
                                id="{{ $input['name'].$data->id }}" cols="10"
                                rows="5">{{ (array_key_exists($input['name'], $data->getOriginal())) ? $data->getOriginal()[$input['name']] : '' }}</textarea>
                        </div>
                        @endif
                        @endforeach
                        <div class="col-sm-6 col-12 form-group">
                            <label for="employee_id{{$data->id}}">Asesor</label>
                            <select class="form-control" name="employee_id" disabled id="employee_id{{$data->id}}">
                                <option selected='selected' value="{{ $data->employee_id }}">
                                    {{$data->employee ? $data->employee->name : 'Seleccione' }}
                                </option>
                            </select>
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