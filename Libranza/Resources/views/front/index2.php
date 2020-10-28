<!DOCTYPE html>
<html lang="es">
<?php
header('Strict-Transport-Security: max-age=0;');
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
    <meta name="author" content="Oportunidadaes Libranza">
    <title>Libranza Fácil - Oportunidades Libranza</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.min.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css" />
    <link rel="stylesheet" type="text/css" href="css/whatsapp.min.css" />
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css" />
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c1313463c5.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="resources/assets/oportunidadesServicios.ico" />
    <meta name="description" content="Ingresa a Libranzafacil.com y Obten tu crédito por Libranza para pensionados,
    docentes y militares muy fácil, solicítalo Online." />
    <meta property="og:type" content="Website" />
    <meta property="og:title" content="Libranza Facil" />
    <meta property="og:description" content="Ingresa a Libranzafacil.com y Obten tu crédito por Libranza para pensionados,
    docentes y militares muy fácil, solicítalo Online. Crédito por Libranza para pensionados, docentes y militares, hasta
    con 120 meses de plazo, aprobamos hasta los 84 años y Somos especialistas en Fondos Privados, Si estas reportado, te
    damos una segunda Oportunidad." />
    <meta property="og:image" content="https://libranzafacil.com/resources/assets/Portada_OGV.jpg" />
    <meta property="og:url" content="https://libranzafacil.com/" />
    <meta property="og:site_name" content="LibranzaFacil.com" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jqueryMigrate.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/ciudades.min.js"></script>
    <script type="text/javascript" src="js/whatsapp.min.js"> </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Ads: 781153823 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-781153823"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'AW-781153823');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-164894259-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-164894259-1');
    </script>
    <script>
    (function(h, e, a, t, m, p) {
        m = e.createElement(a);
        m.async = !0;
        m.src = t;
        p = e.getElementsByTagName(a)[0];
        p.parentNode.insertBefore(m, p);
    })(window, document, 'script', 'https://u.heatmap.it/log.js');
    </script>
    <style>
    #emailAlert {
        display: block;
        padding: 0px 15px;
        font-size: 11px;
        font-weight: bold;
        position: absolute;
        display: none;
    }

    .imgFon {
        position: initial !important;
        margin: auto;
    }

    .content-textTitleNav {
        border-right: initial;
    }
    </style>
</head>

<body>
    <div id="contenedor_carga">
        <div class="loader"></div>
    </div>
    <script>
    window.onload = function() {
        var contenedor = document.getElementById('contenedor_carga');
        contenedor.style.visibility = 'hidden';
        contenedor.style.opacity = '0';
    }
    </script>
    <script>
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = [8, 37, 39, 46];

        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial)
            return false;
    }

    function limpia() {
        var val = document.getElementById("miInput").value;
        var tam = val.length;
        for (i = 0; i < tam; i++) {
            if (!isNaN(val[i]))
                document.getElementById("miInput").value = '';
        }
    }
    </script>
    <script>
    function validaNumericos(event) {
        if (event.charCode >= 48 && event.charCode <= 57) {
            return true;
        }
        return false;
    }
    </script>
    <nav class="navbar navbar-expand navbar-light bg-white">
        <div class="row w-100 d-flex align-items-center text-center row-reset">

            <div style="margin-left: auto;margin-right: auto;"
                class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-3 col-reset">
                <a href="/inicio" style=" margin-top: 5px;" class="nav-link centrado"> <img class="w-imgLog"
                        src="resources/assets/LogoLibranza.png" alt=""> </a>

            </div>
            <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4 col-reset content-textTitleNav">
                <p class="titleNav">
                    <span class="title-form mt-1 text-center ">
                    <strong>¿REPORTADO?</strong>
                    </span>
                    <br>
                    <span class="title-form2 text-center" style="color:#1cbaf8">
                        Te damos una segunda <br>
                    </span>
                    <span class="title-form2 text-left" style="color:#1cbaf8">
                        <strong> oportunidad </strong>
                    </span>
                </p>
            </div>
            <div style="margin-left: auto;margin-right: auto;"
                class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-3 col-reset ">
                <a href="https://www.oportunidades.com.co/" style=" margin-top: 5px;" class="nav-link centrado"> <img
                        class="w-imgLog" src="resources/assets/oportunidades.jpg" alt=""> </a>

            </div>
        </div>
    </nav>
    <div>
        <div class=" row-reset row contenedor my-4">
            <div class="col-12">
                <div class="imgFon">
                    <div class="form-fondo shadow-lg clearfix">
                        <form class="form-group " method="POST" action="api/guardarCliente.php">
                            <div class=" text-center ">
                                <div class="col-reset">
                                    <p class="title-start">¡La manera mas fácil de tener crédito por libranza!</p>
                                    <span class="title-form3 text-center">
                                        Prestamos hasta los <b>84 años de edad</b>
                                    </span>
                                    <div class="form-row mt-2">
                                        <div class="col-md-12 mb-3">
                                            <span class="point badge "> </span>
                                            <div class="form-control input-color">
                                                <p><img class="img-fluid icono-form" src="resources/assets/Icono.png"
                                                        alt="">
                                                    <span class="text-input"> Cuéntanos sobre ti </span> <span
                                                        class="text-input2">(ingresa tus datos personales)</span>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-6 mb-3 ">
                                            <label class="labelInput" id="name" for="nombres">Nombres <span
                                                    class="text-danger" style=" font-weight: bold; "> * </span></label>
                                            <input type="text" onkeypress="return soloLetras(event)"
                                                class="form-control form-control-reset" id="nombres" name="nombres"
                                                required>
                                            <div class="valid-feedback">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                                            <label class="labelInput" id="lastName" for="apellidos">Apellidos <span
                                                    class="text-danger" style=" font-weight: bold; "> * </span></label>
                                            <input type="text" onkeypress="return soloLetras(event)"
                                                class="form-control" id="apellidos" name="apellidos" required>

                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                                            <label class="labelInput" for="numcedula">N° de Cédula <span
                                                    class="text-danger" style=" font-weight: bold; ">
                                                    * </span></label>
                                            <input type="text" onkeypress='return validaNumericos(event)'
                                                class="form-control" id="numcedula" name="numcedula" required>

                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                                            <label class="labelInput" for="email">Correo electrónico <span
                                                    class="text-danger" style=" font-weight: bold; "> * </span></label>
                                            <input type="email" class="form-control" id="email" name="email" required>

                                            <span class="alert alert-danger" id="emailAlert">Los correos no
                                                coinciden</span>
                                            <p>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                                            <label class="labelInput" id="telephone" for="phone">Teléfono Celular<span
                                                    class="text-danger" style=" font-weight: bold; "> * </span></label>
                                            <input type="text" class="form-control" minlength="10" maxlength="10"
                                                onkeypress='return validaNumericos(event)' id="phone" name="phone"
                                                required>

                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                                            <label class="labelInput" for="emailconfirm">Confirmar correo electrónico
                                                <span class="text-danger" style=" font-weight: bold; "> *
                                                </span></label>
                                            <input type="email" class="form-control" id="emailConfirm"
                                                name="emailConfirm" required onblur="confirmEmail()">

                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                                            <label class="labelInput" for="validationCustom02">Buscar Ciudad <span
                                                    class="text-danger" style=" font-weight: bold; "> * </span></label>
                                            <select class="form-control" id="ciudad" name="ciudad" required>
                                            </select>

                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                                            <label class="labelInput" for="tipoper">Ocupación <span class="text-danger"
                                                    style=" font-weight: bold; "> *
                                                </span></label>
                                            <select class="form-control" id="tipoper" name="tipoper"
                                                placeholder="Seleccione los programas de su interes" required>
                                                <option value="Pensionado" selected>Pensionado</option>
                                            </select>

                                            <input type="hidden" value="Libranza" class="form-control" id="servicio"
                                                name="servicio" type="text">
                                            <input type="hidden" value="Prestamo por Libranza" class="form-control"
                                                id="product" name="product" type="text">
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                                            <label class="labelInput" for="monto">Indícanos el monto a solicitar <span
                                                    class="text-danger" style=" font-weight: bold; "> * </span></label>
                                            <select style="font-size:12px" class="form-control" name="monto"
                                                placeholder="Seleccione los programas de su interes" required>
                                                <option value selected>Desde $500.000 hasta $80.000.000</option>
                                                <option value="500000">$ 500.000</option>
                                                <option value="1000000">$ 1.000.000</option>
                                                <option value="2000000">$ 2.000.000</option>
                                                <option value="3000000">$ 3.000.000</option>
                                                <option value="4000000">$ 4.000.000</option>
                                                <option value="5000000">$ 5.000.000</option>
                                                <option value="6000000">$ 6.000.000</option>
                                                <option value="7000000">$ 7.000.000</option>
                                                <option value="8000000">$ 8.000.000</option>
                                                <option value="9000000">$ 9.000.000</option>
                                                <option value="10000000">$ 10.000.000</option>
                                                <option value="11000000">$ 11.000.000</option>
                                                <option value="12000000">$ 12.000.000</option>
                                                <option value="13000000">$ 13.000.000</option>
                                                <option value="14000000">$ 14.000.000</option>
                                                <option value="15000000">$ 15.000.000</option>
                                                <option value="16000000">$ 16.000.000</option>
                                                <option value="17000000">$ 17.000.000</option>
                                                <option value="18000000">$ 18.000.000</option>
                                                <option value="19000000">$ 19.000.000</option>
                                                <option value="20000000">$ 20.000.000</option>
                                                <option value="21000000">$ 21.000.000</option>
                                                <option value="22000000">$ 22.000.000</option>
                                                <option value="23000000">$ 23.000.000</option>
                                                <option value="24000000">$ 24.000.000</option>
                                                <option value="25000000">$ 25.000.000</option>
                                                <option value="26000000">$ 26.000.000</option>
                                                <option value="27000000">$ 27.000.000</option>
                                                <option value="28000000">$ 28.000.000</option>
                                                <option value="29000000">$ 29.000.000</option>
                                                <option value="30000000">$ 30.000.000</option>
                                                <option value="31000000">$ 31.000.000</option>
                                                <option value="32000000">$ 32.000.000</option>
                                                <option value="33000000">$ 33.000.000</option>
                                                <option value="34000000">$ 34.000.000</option>
                                                <option value="35000000">$ 35.000.000</option>
                                                <option value="36000000">$ 36.000.000</option>
                                                <option value="37000000">$ 37.000.000</option>
                                                <option value="38000000">$ 38.000.000</option>
                                                <option value="39000000">$ 39.000.000</option>
                                                <option value="40000000">$ 40.000.000</option>
                                                <option value="41000000">$ 41.000.000</option>
                                                <option value="42000000">$ 42.000.000</option>
                                                <option value="43000000">$ 43.000.000</option>
                                                <option value="44000000">$ 44.000.000</option>
                                                <option value="45000000">$ 45.000.000</option>
                                                <option value="46000000">$ 46.000.000</option>
                                                <option value="47000000">$ 47.000.000</option>
                                                <option value="48000000">$ 48.000.000</option>
                                                <option value="49000000">$ 49.000.000</option>
                                                <option value="50000000">$ 50.000.000</option>
                                                <option value="51000000">$ 51.000.000</option>
                                                <option value="52000000">$ 52.000.000</option>
                                                <option value="53000000">$ 53.000.000</option>
                                                <option value="54000000">$ 54.000.000</option>
                                                <option value="55000000">$ 55.000.000</option>
                                                <option value="56000000">$ 56.000.000</option>
                                                <option value="57000000">$ 57.000.000</option>
                                                <option value="58000000">$ 58.000.000</option>
                                                <option value="59000000">$ 59.000.000</option>
                                                <option value="60000000">$ 60.000.000</option>
                                                <option value="61000000">$ 61.000.000</option>
                                                <option value="62000000">$ 62.000.000</option>
                                                <option value="63000000">$ 63.000.000</option>
                                                <option value="64000000">$ 64.000.000</option>
                                                <option value="65000000">$ 65.000.000</option>
                                                <option value="66000000">$ 66.000.000</option>
                                                <option value="67000000">$ 67.000.000</option>
                                                <option value="68000000">$ 68.000.000</option>
                                                <option value="69000000">$ 69.000.000</option>
                                                <option value="70000000">$ 70.000.000</option>
                                                <option value="71000000">$ 71.000.000</option>
                                                <option value="72000000">$ 72.000.000</option>
                                                <option value="73000000">$ 73.000.000</option>
                                                <option value="74000000">$ 74.000.000</option>
                                                <option value="75000000">$ 75.000.000</option>
                                                <option value="76000000">$ 76.000.000</option>
                                                <option value="77000000">$ 77.000.000</option>
                                                <option value="78000000">$ 78.000.000</option>
                                                <option value="79000000">$ 79.000.000</option>
                                                <option value="80000000">$ 80.000.000</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-6 mb-3">
                                            <label class="labelInput" for="plazo">Indícanos el plazo que deseas<span
                                                    class="text-danger" style=" font-weight: bold; "> * </span></label>
                                            <select style="font-size: 14px" class="form-control" name="plazo"
                                                placeholder="Seleccione los programas de su interes" required>
                                                <option value selected>Desde 13 hasta 120 meses...</option>
                                                <option value="13">13</option>
                                                <option value="24">24</option>
                                                <option value="36">36</option>
                                                <option value="48">48</option>
                                                <option value="60">60</option>
                                                <option value="72">72</option>
                                                <option value="84">84</option>
                                                <option value="96">96</option>
                                                <option value="108">108</option>
                                                <option value="120">120</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="labelInput" for="entidad">De que entidad eres <span
                                                    class="text-danger" style=" font-weight: bold; "> * </span></label>
                                            <select class="form-control" name="entidad"
                                                placeholder="Seleccione los programas de su interes" required>
                                                <option value selected>Selecciona tu entidad...</option>
                                                <option value="Axa Colpatria Renta Vitalicia">Axa Colpatria Renta
                                                    Vitalicia
                                                </option>
                                                <option value="BBVA Seguros">BBVA Seguros </option>
                                                <option value="Casur">Casur</option>
                                                <option value="Colfondos">Colfondos</option>
                                                <option value="Colpensiones">Colpensiones</option>
                                                <option value="Ferrocarriles">Ferrocarriles</option>
                                                <option value="Foncep">Foncep</option>
                                                <option value="Fopep">Fopep</option>
                                                <option value="Global Seguros ">Global Seguros </option>
                                                <option value="Mapfre">Mapfre</option>
                                                <option value="Porvenir">Porvenir</option>
                                                <option value="Protección">Proteccion</option>
                                                <option value="Seguros Alfa">Seguros Alfa </option>
                                                <option value="Seguros Bolívar ARL">Seguros Bolivar ARL </option>
                                                <option value="Seguros Bolívar Renta">Seguros Bolivar Renta </option>
                                                <option value="Seguros Alfa">Seguros Alfa</option>
                                                <option value="Suramericana">Suramericana</option>
                                                <option value="Skandia">Skandia</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group " style="text-align:center; font-size:11px;margin-bottom: 2%;">
                                    <p style="margin-bottom: 2%;">Acepto Términos, condiciones y Política de tratamiento
                                        de
                                        datos
                                        <input required style="height:auto " type="checkbox" id="cbox2"
                                            value="second_checkbox">
                                    </p>
                                </div>
                                <div class="form-row   ">
                                    <div class="col-md-12  ">

                                        <button onclick="confirmEmail()" id=" boton" style="cursor: pointer;"
                                            type="submit" class="input-button boton-form2 form-control"> YA ESTOY LISTO
                                            PARA
                                            SOLICITARLO</button>

                                    </div>
                                </div>
                                <p class="mt-2" style="font-size: 12px;margin-top: 4px !important;margin-bottom: -2%;">
                                    La aprobación del monto y plazo sujetos a políticas de crédito.</p>
                                <p class="mt-2" style="font-size: 12px;margin-top: 8px !important;margin-bottom: 0%;">
                                    Dejanos tus datos y un
                                    asesor se comunicara contigo para continuar con tu solicitud. </p>
                                <p
                                    style="font-size: 10px; margin-top: 2px !important; margin-bottom: -24px !important;">
                                    Si
                                    quieres más información comunicate con nosotros a este WhatsApp 312
                                    2399959
                                </p>
                            </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <div id="footer" class="footer-lib">
        <div style="padding: 10px 0px 20px 0px;" class="row text-center row-reset">
            <div class="col-12 col-md-12">
                <h3 class="TitleFoot">Si tienes alguna inquietud <strong>¡Contáctanos!</strong></h3>
            </div>
        </div>
        <div style="padding-bottom: 25px;" class="row text-center row-reset">
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <img class="w-imgLogFooter" src="resources/assets/OportunidadesLibranza.png" alt="">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-md-12">
                        <div class="text-left">
                            <ul class="text-items">
                                <h5 style="font-weight: bold;" class="text-items1">NOSOTROS</h5>
                                <li><a class="text-items1" href="/codigo-etica"
                                        title="Código de ética y buen gobierno corporativo">Código de ética y buen
                                        gobierno corporativo</a></li>
                                <li><a class="text-items1" href="/quienes-somos" title="Quiénes somos">Quiénes somos</a>
                                </li>
                                <li><a class="text-items1" href="/Proteccion-de-datos-personales"
                                        title="Protección de datos personales">Protección de datos personales</a></li>
                                <li><a class="text-items1" href="/Terminos-y-condiciones"
                                        title="Términos y condiciones">Términos y condiciones</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="row row-reset">
                            <div class="col-12">
                                <div style="line-height: 15px;">
                                    <span> <img src="resources/assets/footer-telefonoIcon.png" alt=""> Linea nacional 57
                                        (1)484 2122 - 01 8000 18 05 20</span>
                                    <br>
                                    <span>Lunes a Viernes 8:00 am a 5:00 pm</span>
                                </div>
                            </div>
                            <div class="text-left mt-4">
                                <ul class="text-items">
                                    <h5 style="font-weight: bold;" class="text-items1">SERVICIO AL CLIENTE</h5>
                                    <li><a class="text-items1" href="/Por-que-comprar-con-nosotros"
                                            class="footer-menuItem" title="Por qué comprar con nosotros">Por qué comprar
                                            con nosotros</a></li>
                                    <li><a class="text-items1" href="/Cambios-devoluciones-y-atencion-de-garantias"
                                            class="footer-menuItem"
                                            title="Cambios , devoluciones y atención de garantías">Cambios ,
                                            devoluciones y atención de garantías</a></li>
                                    <li><a class="text-items1" href="http://www.sic.gov.co/proteccion-del-consumidor"
                                            target="_blank" class="footer-menuItem"
                                            title="Protección al consumidor">Protección al consumidor</a></li>
                                    <li><a class="text-items1" href="/Preguntas-frecuentes" class="footer-menuItem"
                                            title="Preguntas Frecuentes">Preguntas Frecuentes</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">
                <div class="row">
                    <div class="col-12 col-md-12 mt-5">
                        <div class="row row-reset">
                            <div class="col-12 col-md-12">
                                <h5 style="font-weight: bold; font-size: 18px;" class="footer-titleNewsLetter">QUIERES
                                    RECIBIR LAS MEJORES OFERTAS</h5>
                            </div>
                        </div>
                        <div class="row row-reset">
                            <div class="row m-auto">
                                <div class="col-12 col-md-12 m-auto">
                                    <a style="color:#b1b1b1;" href="https://www.facebook.com/almacenes.oportunidades/"
                                        target="_blank"><span class="footer-menuText">Síguenos
                                        <i style="font-size: 40px; color:#0063ab;" class="fab fa-facebook" aria-hidden="true"></i>    
                                        <!-- <img src="resources/assets/FacebookFooter.png" alt=""> -->
                                        <a href="https://www.facebook.com/almacenes.oportunidades/"
                                                target="_blank"></a></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- hasta aqui -->

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/jqueryMigrate.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="js/ciudades.min.js"></script>
<script type="text/javascript" src="js/whatsapp.min.js"> </script>
<script>

</script>
<script type="text/javascript">
// 1. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '100%',
        width: '100%',
        playerVars: {
            loop: 1,
            controls: 1,
            showinfo: 1,
            autohide: 1,
            modestbranding: 1,
            autoplay: 0,
            vq: 'hd720'
        },
        videoId: 'QQdp5gF7LAw',
        events: {
            'onStateChange': onPlayerStateChange
        }
    });
}

// 3. The API will call this function when the video player is ready.
function onPlayerReady(event) {
    event.target.playVideo();
}

var done = false;
</script>

<script type="text/javascript">
$(function() {
    $('#WAButton').floatingWhatsApp({
        phone: '573138701355', //WhatsApp Business phone number
        headerTitle: 'Chatea con nosotros por WhatsApp !', //Popup Title
        popupMessage: 'Hola, como podemos ayudarte?', //Popup Message
        showPopup: true, //Enables popup display
        buttonImage: '<img src="whatsapp.svg" />', //Button Image
        // headerColor: 'crimson', //Custom header color
        //backgroundColor: 'crimson', //Custom background button color
        position: "right" //Position: left | right

    });
});
</script>
<script type="text/javascript">
var email = document.getElementById("email").value;
var emailConfirm = document.getElementById("emailConfirm").value;

if (email != emailConfirm) {
    document.getElementById("emailAlert").style.display = "block";
    document.getElementById("email").value = "";
} else {
    document.getElementById("emailAlert").style.display = "none";
}
</script>
<script type="text/javascript">
// 1. This code loads the IFrame Player API code asynchronously.
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

function stopVideo() {
    player.stopVideo();
}
</script>
<script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "WebSite",
    "name": "Libranza Facil",
    "url": "https://libranzafacil.com/",
    "sameAs": [
        "https://www.facebook.com/almacenes.oportunidades/",
        "https://www.instagram.com/almacenes.oportunidades/"
    ],
    "potentialAction": {
        "@type": "SearchAction",
        "target": "https://libranzafacil.com/{search_term_string}",
        "query-input": "required name=search_term_string"
    }
}
</script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'UA-164894259-1');
</script>

</html>