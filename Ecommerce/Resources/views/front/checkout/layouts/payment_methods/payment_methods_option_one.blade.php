<div class="w-100 mt-3">
    <div class="card">
        <div class="card-body">
            <div class="my-auto">
                <h6>Metodos de pago</h6>
            </div>

            <div class="row w-100">
                <div class="col-sm-4 mt-4 px-0">
                    <div class="ml-2">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link paymentMethods active" id="v-pills-creditCards" data-toggle="pill"
                                href="#creditCards" role="tab" aria-controls="creditCards" aria-selected="true">Tarjeta
                                de crédito</a>
                            <a class="nav-link paymentMethods" id="v-pills-pse" data-toggle="pill" href="#pse"
                                role="tab" aria-controls="pse" aria-selected="true">Pago PSE</a>
                            <a class="nav-link paymentMethods" id="v-pills-profile-tab" data-toggle="pill"
                                href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                aria-selected="false">Baloto </a>
                            <a class="nav-link paymentMethods" id="v-pills-messages-tab" data-toggle="pill"
                                href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                aria-selected="false">Efecty o Gana</a>
                            <a class="nav-link paymentMethods" id="v-pills-settings-tab" data-toggle="pill"
                                href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                                aria-selected="false">QR Bancolombia</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 px-0 bg-paymentMethods">
                    <div class="mx-3">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="creditCards" role="tabpanel"
                                aria-labelledby="v-pills-creditCards">
                                @include('ecommerce::front.payments.credit-card')
                            </div>
                            <div class="tab-pane fade" id="pse" role="tabpanel" aria-labelledby="v-pills-pse">
                                @include('ecommerce::front.payments.pse')
                            </div>
                            <div class="tab-pane fade " id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <div class="row mb-3 justify-content-center">
                                    <div class="p-3 text-center">
                                        <div style="max-width: 135px;margin: auto;">
                                            <img src="{{asset('img/cards/baloto.png')}}" class="img-fluid" alt="baloto">
                                        </div>
                                        Consignación vía Baloto
                                        <br>
                                        <br>
                                        <form action="{{ route('baloto.store') }}" class="form-horizontal"
                                            method="post">
                                            {{ csrf_field() }}
                                            <div class="btn-group">
                                                <button onclick="return confirm('¿Estás Seguro?')"
                                                    class="btn btn-primary btn-sm mx-auto">Continuar con
                                                    este
                                                    método de pago</button>
                                                <input type="hidden" name="billing_address"
                                                    value="{{ $billingAddress->id }}">
                                                @if(request()->has('courier'))
                                                <input type="hidden" name="courier"
                                                    value="{{ request()->input('courier') }}">
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                aria-labelledby="v-pills-messages-tab">
                                <div class="row mb-3 justify-content-center">
                                    <div class="p-3 text-center">
                                        Giro a cuenta
                                        <br>
                                        <br>
                                        <div style="max-width: 135px;margin: auto;">
                                            <img src="{{asset('img/cards/efecty.png')}}" class="img-fluid"
                                                alt="logo-efecty">
                                            <img src="{{asset('img/cards/gana.png')}}" class="img-fluid"
                                                alt="logo-gana">
                                        </div>
                                        <br>
                                        <form action="{{ route('efecty.store') }}" class="form-horizontal"
                                            method="post">
                                            {{ csrf_field() }}
                                            <div class="btn-group">
                                                <button onclick="return confirm('¿Estás Seguro?')"
                                                    class="btn btn-primary btn-sm mx-auto">Continuar con
                                                    este
                                                    método de pago</button>
                                                <input type="hidden" name="billing_address"
                                                    value="{{ $billingAddress->id }}">
                                                @if(request()->has('courier'))
                                                <input type="hidden" name="courier"
                                                    value="{{ request()->input('courier') }}">
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                aria-labelledby="v-pills-settings-tab">
                                <div class="row mb-3 justify-content-center">
                                    <div class="p-3 text-center">
                                        <div style="max-width: 135px;margin: auto;">
                                            <img src="{{asset('img/cards/logo-bancolombia.png')}}" class="img-fluid"
                                                alt="logo-bancolombia">
                                        </div>
                                        Pago a través de transferencia electrónica directa a una cuenta de
                                        ahorros o a través de código QR
                                        <br>
                                        <br>
                                        <form action="{{ route('bank-transfer.store') }}" class="form-horizontal"
                                            method="post">
                                            {{ csrf_field() }}
                                            <div class="btn-group">
                                                <button onclick="return confirm('¿Estás Seguro?')"
                                                    class="btn btn-primary btn-sm mx-auto">Continuar con
                                                    este
                                                    método de pago</button>
                                                <input type="hidden" name="billing_address"
                                                    value="{{ $billingAddress->id }}">
                                                @if(request()->has('courier'))
                                                <input type="hidden" name="courier"
                                                    value="{{ request()->input('courier') }}">
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
