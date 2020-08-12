<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>fvn</title>
  <link rel="icon" href="{{asset('img/fvn/logo.png')}}" type="image/png">
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/style.css')}}">
  <!-- Event snippet for Website traffic conversion page -->
  <script>
    gtag('event', 'conversion', {'send_to': 'AW-604881959/T2tHCK7X6toBEKeIt6AC'}); 
  </script>
  <style>
    .alert-success {
      color: #fff;
      border-color: #4fd69c;
      background-color: #4fd69c;
    }
  </style>
</head>

<body>
  <!--::banner part start::-->
  <section class="banner_part">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-5">
          <div class="banner_img d-block">
            <img src="{{asset('img/thankYouPage/banner_img.png')}}" alt="">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="banner_text">
            <div class="banner_text_iner">
              <p class="alert alert-success">Tu orden está en camino!</p>
              <h1>Gracias!</h1>
              <p><span>Tu solicitud de compra</span>
                <br>
                <span>fue efectuada con exito</span>

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
                <a href="{{route('home')}}" class="btn_2">Ver más productos</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <img src="{{asset('img/thankYouPage/animate_icon/Ellipse_7.png')}}" alt="" class="feature_icon_1 custom-animation1">
    <img src="{{asset('img/thankYouPage/animate_icon/Ellipse_8.png')}}" alt="" class="feature_icon_2 custom-animation2">
    <img src="{{asset('img/thankYouPage/animate_icon/Ellipse_1.png')}}" alt="" class="feature_icon_3 custom-animation3">
    <img src="{{asset('img/thankYouPage/animate_icon/Ellipse_2.png')}}" alt="" class="feature_icon_4 custom-animation4">
    <img src="{{asset('img/thankYouPage/animate_icon/Ellipse_3.png')}}" alt="" class="feature_icon_5 custom-animation5">
    <img src="{{asset('img/thankYouPage/animate_icon/Ellipse_4.png')}}" alt="" class="feature_icon_6 custom-animation6">
    <div class="modal fade" id="imgQr" tabindex="-1" role="dialog" aria-labelledby="imgQrLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="w-100">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> </div>

            <div class="row">
              <img src="{{asset('img/fvn/codeQr.jpg')}}" class="img-fluid" alt="code-qr">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</body>
<script src="{{ asset('js/front/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/front/sweetalert2.js') }}"></script>
<script src="{{ asset('js/front/front.js') }}"></script>
<script src="{{ asset('js/admin/validate.js') }}"></script>

</html>