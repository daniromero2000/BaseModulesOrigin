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
              <hr>
              <p class="alert alert-success">Tu orden está en camino!</p>
              <hr>
              <h1>Gracias!</h1>
              <p><span>Tu solicitud de compra</span>
                <span>por la orden {{ $order }}</span>
                <br>
                <span>fue efectuada</span>
                por un valor de <span class="total">${{ number_format($total, 0) }}</span>
                <br>
                <br>
                @if(isset($transaction_id))
                <span>Identificador de transacción </span><span class="total">{{ $transaction_id }}</span>
                @endif
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