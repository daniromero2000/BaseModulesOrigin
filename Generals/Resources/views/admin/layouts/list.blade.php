<div class="table-responsive">
    <table class="table align-items-center table-flush table-hover">
        <thead class="thead-light">
            <tr>
                @foreach ($headers as $header)
                <th class="text-center">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($datas as $data)
            <tr>

                @foreach ($data->toArray() as $key2 => $value)
                @if(!is_array($value))
                <td class="text-center">
                    {{ $value }}
                </td>
                @endif
                @endforeach
                <td>
                    @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                    $optionsRoutes])
                </td>
            </tr>

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
                        <form action="{{ route($routeEdit, $data->id) }}" method="post" class="form">
                            @csrf
                            @method('PUT')
                            <div class="modal-body py-0">
                                <input name="employee_id" id="employee_id" type="hidden" value="{{ $data->id }}">
                                <div class="row">
                                    @foreach ($inputs as $input)
                                    @if($input['type'] == 'text' || $input['type'] == 'number' || $input['type'] ==
                                    'date' || $input['type'] == 'time' || $input['type'] == 'url')
                                    <div class="col-sm-6 col-12 form-group">
                                        <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                        <input type="{{ $input['type'] }}" id="{{ $input['name'] }}"
                                            value="{{ (array_key_exists($input['name'], $data->getOriginal())) ? $data->getOriginal()[$input['name']] : '' }}"
                                            name='{{ $input['name'] }}' step="any" class="form-control">
                                    </div>
                                    @elseif($input['type'] == 'select')
                                    <div class="col-sm-6 col-12 form-group">
                                        <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                        <select class="form-control" name="{{ $input['name'] }}"
                                            id="{{ $input['name'] }}">
                                            @foreach ($input['options'] as $option)
                                            <option @if($data->getOriginal()[$input['name']] == $option['id'])
                                                selected='selected' @endif
                                                value="{{ $option['id'] }}">{{ $option['label'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @elseif($input['type'] == 'textarea')
                                    <div class="col-12 form-group">
                                        <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                        <textarea class="form-control" name="{{ $input['name'] }}"
                                            id="{{ $input['name'] }}" cols="10"
                                            rows="5">{{ (array_key_exists($input['name'], $data->getOriginal())) ? $data->getOriginal()[$input['name']] : '' }}</textarea>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">

                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>