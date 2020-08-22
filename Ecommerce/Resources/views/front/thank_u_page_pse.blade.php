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
      tu pedido.</span>

    <br>
  </p>

  <hr class="mt-4" style="border-top: 2px solid rgb(0 46 84 / 69%);">

  <div class="banner_text w-100">
    <div class="banner_text_iner">
      @php
      if ($_REQUEST) {
      $referenceCode = $_REQUEST['referenceCode'];
      $TX_VALUE = $_REQUEST['TX_VALUE'];
      $currency = $_REQUEST['currency'];
      $transactionState = $_REQUEST['transactionState'];
      $reference_pol = $_REQUEST['reference_pol'];
      $cus = $_REQUEST['cus'];
      $description = $_REQUEST['description'];
      $pseBank = $_REQUEST['pseBank'];
      $lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
      $transactionId = $_REQUEST['transactionId'];

      switch ($transactionState) {
      case 4:
      $estadoTx = "Transacción aprobada";
      break;
      case 6:
      $estadoTx = "Transacción rechazada";
      break;
      case 7:
      $estadoTx = "Transacción pendiente";
      break;
      case 104:
      $estadoTx = "Error";
      break;
      default:
      $estadoTx = $_REQUEST['mensaje'];
      }
      }
      @endphp

      <h2>Resumen Transacción</h2>
      <ul>
        <li><b>Empresa: </b> FVN</li>
        <li><b>Nit: </b> </li>
        <li><b>Fecha: </b> </li>
        @if(isset($estadoTx))
        <li><b>Estado de la transaccion:</b> {{ $estadoTx }} </li>
        @endif
        @if(isset($referenceCode))
        <li><b>Referencia de la transaccion:</b> {{ $referenceCode }} </li>
        @endif
        @if(isset($transactionId))
        <li><b>ID de la transaccion:</b> {{ $transactionId }} </li>
        @endif
        @if(isset($TX_VALUE))
        @if ($pseBank != null)
        <li><b>Cus:</b> {{ $cus }} </li>
        <li><b>Banco:</b> {{ $pseBank }} </li>
        @endif
        @endif
        @if(isset($TX_VALUE))
        <li><b>Valor total: </b>${{ number_format($TX_VALUE) }} </li>
        @endif
        @if(isset($currency))
        <li><b>Moneda: </b> {{ $currency }} </li>
        @endif
        @if(isset($description))
        <li><b>Descripción: {{ $description }} </b> </li>
        @endif
      </ul>
    </div>
  </div>
</div>

@endsection