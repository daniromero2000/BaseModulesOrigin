@php
$actions = session('actionsModule');
$searchExport = request()->input();
@endphp
<div class="ml-auto justify-content-end d-flex" style=" position: absolute; top: 22px; right: 3%; z-index: 99; ">
    <p>
        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#contentId"
            aria-expanded="{{ request()->input() ? 'true' : 'false' }}" aria-controls="contentId">
            Filtrar
        </a>
        @if ($actions)
            @foreach ($actions as $action)
                @if (strpos($action['route'], 'import'))
                    <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default">
                        Cargar base
                    </a>


                @endif
            @endforeach
        @endif
    </p>
</div>
<div class="collapse mt-3 {{ request()->input() ? 'show' : '' }}" id="contentId">
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <form action="{{ $route }}" method="get" id="admin-search">
                    <div class="row d-flex justify-content-start">
                        @foreach ($searchInputs as $input)
                            @if ($input['type'] == 'text' || $input['type'] == 'number' || $input['type'] == 'date' || $input['type'] == 'time' || $input['type'] == 'datetime-local' || $input['type'] == 'url' || $input['type'] == 'file')
                                <div class="col-sm-6 col-md-4 col-12 form-group">
                                    <label for="{{ $input['name'] }}"
                                        class="form-control-label">{{ $input['label'] }}</label>
                                    <input type="{{ $input['type'] }}" id="{{ $input['name'] }}"
                                        value="{!!  request()->input($input['name']) !!}" name='{{ $input['name'] }}'
                                        step="any" class="form-control form-control-sm">
                                </div>
                            @elseif($input['type'] == 'select')
                                <div class="col-sm-6 col-md-4 col-12 form-group">
                                    <label for="{{ $input['name'] }}"
                                        class="form-control-label">{{ $input['label'] }}</label>
                                    <select class="form-control form-control-sm" name="{{ $input['name'] }}"
                                        id="{{ $input['name'] }}">
                                        @foreach ($input['options'] as $option)
                                            <option value="{{ $option['id'] }}">{{ $option['label'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @elseif($input['type'] == 'textarea')
                                <div class="col-12 form-group">
                                    <label for="{{ $input['name'] }}"
                                        class="form-control-label">{{ $input['label'] }}</label>
                                    <textarea class="form-control form-control-sm" name="{{ $input['name'] }}"
                                        id="{{ $input['name'] }}" cols="10"
                                        rows="5">{!!  request()->input($input['name']) !!}</textarea>
                                </div>
                            @elseif($input['type'] == 'checkbox')
                                <div class="col-12">
                                    <h4 class="mb-3"> {{ $input['title'] }}</h4>
                                </div>
                                <div class="row mx-2">
                                    @foreach ($input['array'] as $option)
                                        <div class="px-2">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="custom-control-input " name='{{ $input['name'] }}'
                                                    id="{{ $option->id . $data->id }}" type="checkbox"
                                                    value="{{ $option->id }}"
                                                    {{ isset($attached[$data->id]) && in_array($option->id, $attached[$data->id]) ? 'checked="checked"' : '' }}>
                                                <label class="custom-control-label"
                                                    for="{{ $option->id . $data->id }}">{{ $option[$input['label']] }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                        <div class="col-12 mt-3">
                            <div class="col-12 d-flex ">
                                <span class="input-group-btn ml-auto btn-pr">
                                    <form action="{{ $route }}" method="get" id="admin-search">
                                        @if (request()->input() != null)
                                            <span class="input-group-btn">
                                                <a title="Recuperar" href="{{ $route }}" id="recover"
                                                    class="btn btn-danger btn-sm">Restaurar</a>
                                            </span>
                                        @endif
                                    </form>
                                    <button type="submit" id="search-btn" class="btn btn-primary btn-sm"><i
                                            class="fa fa-search"></i>
                                        Buscar
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
            aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">Cargar Base</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-control-label">Tipo de carge</label>
                            <select name="type" class="form-control" id="">
                                <option value="0">Añadir archivo</option>
                                <option value="1">Cargar nuevamente</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label">Archivo</label>
                            <input class="form-control" name="src" type="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link btn-md mr-auto" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary btn-md">Guardar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
