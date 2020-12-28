<div class="modal fade" id="modal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar <b>{{ $data->name }}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($routeEdit, $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        @foreach ($inputs as $input)
                            @if ($input['type'] == 'text' || $input['type'] == 'number' || $input['type'] == 'date' || $input['type'] == 'time' || $input['type'] == 'url' || $input['type'] == 'file')
                                <div class="col-sm-6 col-12 form-group">
                                    <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                    <input type="{{ $input['type'] }}" id="{{ $input['name'] }}"
                                        value="{{ array_key_exists($input['name'], $data->getOriginal()) ? $data->getOriginal()[$input['name']] : '' }}"
                                        name='{{ $input['name'] }}' step="any" class="form-control">
                                </div>
                            @elseif($input['type'] == 'select')
                                <div class="col-sm-6 col-12 form-group">
                                    <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                    <select class="form-control" name="{{ $input['name'] }}" id="{{ $input['name'] }}">
                                        @foreach ($input['options'] as $option)
                                            <option
                                                {{ $data->getOriginal()[$input['name']] == $option['id'] ? "selected='selected'" : '' }}
                                                value="{{ $option['id'] }}">{{ $option[$input['option']] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @elseif($input['type'] == 'textarea')
                                <div class="col-12 form-group">
                                    <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                    <textarea class="form-control" name="{{ $input['name'] }}" id="{{ $input['name'] }}"
                                        cols="10"
                                        rows="5">{{ array_key_exists($input['name'], $data->getOriginal()) ? $data->getOriginal()[$input['name']] : '' }}</textarea>
                                </div>
                            @elseif($input['type'] == 'textarea')
                                <div class="col-12 form-group">
                                    <label for="{{ $input['name'] }}">{{ $input['label'] }}</label>
                                    <textarea class="form-control" name="{{ $input['name'] }}" id="{{ $input['name'] }}"
                                        cols="10"
                                        rows="5">{{ array_key_exists($input['name'], $data->getOriginal()) ? $data->getOriginal()[$input['name']] : '' }}</textarea>
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
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
