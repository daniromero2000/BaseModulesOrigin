<form action="{{ route('pse.store') }}" method="POST">
    @csrf
    <div class="row py-4">
        <div class="col-12">
            <div style="max-width: 100px;margin: auto;">
                <img src="{{asset('img/cards/logo-pse.png')}}" class="img-fluid" alt="PSE">
            </div>
            1. Todas las compras y pagos por PSE son realizados en línea y la confirmación es inmediata.
            <br><br>
            2. Algunos bancos tienen un procedimiento de autenticación en su página (Por ejemplo, una segunda clave). Si
            nunca has realizado pagos por internet con tu cuenta de ahorros o corriente, es posible que necesites
            tramitar una autorización ante tu banco. Si tienes dudas puedes consultar los requisitos de cada banco.
            <br>
            <br>
            <div class="form-group">
                <label class="text-sm " for="">Banco</label>
                <select class="form-control" required name="PSE_FINANCIAL_INSTITUTION_CODE" id="exampleFormControlSelect1">
                    @foreach ($banks as $item)
                    <option value="{{$item->pseCode}}">{{$item->description}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="text-sm " for="">Nombre del titular</label>
                <input type="text" class="form-control" required id="" name="BUYER_NAME" aria-describedby="textHelp">
            </div>
            <div class="form-group">
                <label class="text-sm " for="">Tipo Cliente</label>
                <select class="form-control" required name="PAYER_PERSON_TYPE" id="exampleFormControlSelect1">
                    <option value="N">Persona Natural</option>
                    <option value="J">Persona Jurídica</option>
                </select>
            </div>
            <div class="form-group">
                <label class="text-sm " for="">Tipo Documento</label>
                <select class="form-control" required name="PAYER_DOCUMENT_TYPE" id="exampleFormControlSelect1">
                    <option value="CC">C.C (Cédula de ciudadanía)</option>
                    <option value="CE">C.E (Cédula de extranjería)</option>
                    <option value="NIT">NIT (Número de Identificación Tributaria)</option>
                    <option value="TI"> T.I (Tarjeta de Identidad)</option>
                    <option value="PP">Pasaporte</option>
                    <option value="IDC">IDC (Identificador único de cliente)</option>
                    <option value="CEL">CEL (Número móvil)</option>
                    <option value="RC">R.C (Registro civil)</option>
                    <option value="DE">D.E. (Documento de identificación extranjero)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="text-sm " for="">Número de Documento</label>
                <input type="text" required name="PAYER_DNI" class="form-control" id="" aria-describedby="textHelp">
            </div>
            <div class="form-group">
                <label class="text-sm " for="">Número de teléfono</label>
                <input type="text" required name="PAYER_DNI" class="form-control" id="" aria-describedby="textHelp">
            </div>
        </div>
        <script type="text/javascript" src="https://maf.pagosonline.net/ws/fp/tags.js?id=${deviceSessionId}80200">
        </script>
        <noscript>
            <iframe style="width: 100px; height: 100px; border: 0; position: absolute; top: -5000px;"
                src="https://maf.pagosonline.net/ws/fp/tags.js?id=${{$deviceSessionId}}80200"></iframe>
        </noscript>
        @if(!empty($address))

        <input type="hidden" name="billingAddress" value="{{ $address->id }}" id="addressId">
        @endif
        <div class="row mt-4">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Pagar</button>

            </div>
        </div>
    </div>

</form>