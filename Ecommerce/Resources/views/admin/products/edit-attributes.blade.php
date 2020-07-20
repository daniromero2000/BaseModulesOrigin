<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="pAQuantity" class="form-control-label">Cantidad <span class="text text-danger">*</span></label>
            <input type="text" name="pAQuantity" id="pAQuantity" class="form-control"
                value="{!! $pa->quantity ?: old('quantity')  !!}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="pAPrice" class="form-control-label">Precio Normal</label>
            <div class="input-group">
                <input type="text" name="pAPrice" id="pAPrice" class="form-control"
                    value="{!! $pa->price ?: old('price')  !!}">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="pASalePrice" class="form-control-label">Precio Oferta</label>
            <div class="input-group">
                <input type="text" name="pASalePrice" id="pASalePrice" class="form-control"
                    value="{!! $pa->sale_price ?: old('sale_price')  !!}">
            </div>
        </div>
    </div>

    <input type="hidden" name="attributeId" value="{{$pa->id}}">
</div>
<div class="card-footer text-right">
    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
</div>