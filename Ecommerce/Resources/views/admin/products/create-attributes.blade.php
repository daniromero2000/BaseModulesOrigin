<div class="form-group">
    <div class="row">
        @foreach($attributes as $attribute)
        <div class="col-sm-6">
            <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input attribute" name="attribute[]" id="attribute{{ $attribute->id }}"
                    type="checkbox" value="{{ $attribute->id }}">
                <label class="custom-control-label" for="attribute{{ $attribute->id }}">{{ $attribute->name }}</label>
            </div>
            <label for="attributeValue{{ $attribute->id }}" style="display: none; visibility: hidden"></label>
            @if(!$attribute->values->isEmpty())
            <select name="attributeValue[]" id="attributeValue{{ $attribute->id }}" class="form-control select2"
                style="width: 100%" disabled>
                @foreach($attribute->values as $attr)
                <option value="{{ $attr->id }}">{{ $attr->value }}</option>
                @endforeach
            </select>
            @endif
        </div>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="productAttributeQuantity" class="form-control-label">Cantidad <span
                    class="text text-danger">*</span></label>
            <input type="text" name="productAttributeQuantity" id="productAttributeQuantity" class="form-control"
                placeholder="Set quantity" disabled>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="productAttributePrice" class="form-control-label">Precio Normal</label>
            <div class="input-group">
                <input type="text" name="productAttributePrice" id="productAttributePrice" class="form-control"
                    placeholder="Precio Normal" disabled>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="salePrice" class="form-control-label">Precio Oferta</label>
            <div class="input-group">
                <input type="text" name="salePrice" id="salePrice" class="form-control" placeholder="Precio Oferta"
                    disabled>
            </div>
        </div>
    </div>
    <div class="form-group relative">
        <label for="image" class="form-control-label">Imagenes</label>
        <input type="file" name="image[]" id="image" class="form-control" multiple>
        <a class="text-center info-tooltip" data-toggle="tooltip"
            data-original-title="Puedes usar (cmd o ctrl) para seleccionar multiples imagenes">
            ! </a>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="default" class="form-control-label">Mostrar como precio predeterminado?</label> <br />
            <select name="default" id="default" class="form-control select2">
                <option value="0" selected="selected">No</option>
                <option value="1">Si</option>
            </select>
        </div>
    </div>
</div>
<div class="box-footer">
    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-label="Close">Regresar</button>
    <button id="createCombinationBtn" type="submit" class="btn btn-sm btn-primary" disabled="disabled">Crear
        combinación</button>
</div>