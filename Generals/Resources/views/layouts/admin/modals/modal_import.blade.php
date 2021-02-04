<div class="modal fade" id="modal-import{{ $data->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modal-import{{ $data->id }}" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
        <div class="modal-content">
            <form action="{{ route(($optionsRoutes . '.import'), $data->id) }}" method="post"
                enctype="multipart/form-data" class="form">
                @csrf
                @method('PUT')
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
                    <button type="submit" class="btn btn-primary btn-md">Cargar</button>
                </div>
            </form>
        </div>
    </div>
</div>
