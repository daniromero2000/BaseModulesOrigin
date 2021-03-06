@extends('layouts.front.thank_you_page')
@section('content')
<div class="container d-flex mt-4">
  <div class="ml-auto">
    <h3 class="orden">ORDEN N°: FVNO-{{$order}}</h3>
  </div>
</div>

<div class="container mt-3">
  <p class="text-center text-orden">
    <span> Hola {{request()->customer}},</span>
    <br>
    <span><b>Gracias por comprar en FVN online</b></span>
    <br>
    <span>
      Tu pedido ha sido creado con el número FVN-{{$order}} exitosamente en nuestro sistema de información.
    </span>
    <br>
    <span>Nuestra promesa de entrega es de 3 a 7 días hábiles contados a partir del dia hábil después de realizar
      una transferencia a la cuenta <b> No° 85200041360</b> a nombre de <b>Melba
        Herrera</b> por un valor de <span class="total"><b>${{ number_format($total, 0)}}</b>. No por
        consignación ya que esta tiene costo.</span>
      <br>
      <br>
      O escanea un código <b>QR</b> por medio de la app de bancolombia
      <br>
      <br>
      <button class="ml-auto btn btn-sm btn-primary" data-toggle="modal" data-target="#imgQr">Ver
        código</button>
  </p>

  <hr class="mt-4" style="border-top: 2px solid rgb(0 46 84 / 69%);">
</div>
<div class="modal fade" id="imgQr" tabindex="-1" role="dialog" aria-labelledby="imgQrLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="w-100">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> </div>

        <div class="row">
          <img src="{{asset('img/FVN/codeQr.jpg')}}" class="img-fluid" alt="code-qr">
        </div>
      </div>
    </div>
  </div>
</div>

@endsection