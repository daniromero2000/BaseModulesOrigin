<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Libranza Fácil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.min.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css" />
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css" />
    <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c1313463c5.js" crossorigin="anonymous"></script>
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
</head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">

<body>
    <nav class="navbar navbar-expand navbar-light bg-white">
        <div class="row w-100 d-flex align-items-center text-center row-reset">

            <div style="margin-left: auto;margin-right: auto;" class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-3 col-reset">
                <a href="/inicio" style=" margin-top: 5px;" class="nav-link centrado"> <img class="w-imgLog" src="resources/assets/LogoLibranza.png" alt=""> <span class="sr-only">(current)</span></a>
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
            <!-- <div style="margin-left: auto;margin-right: auto;" class="col-12 col-sm-3 col-md-2 col-lg-2 col-xl-2 col-reset siguenos text-center">
                <a href="" target="_blank"><span class="text-contact">Llamanos al tel. </span><br><i style="font-size: 30px;" class="fas fa-phone-alt"></i> </a>
            </div>-->
            <div style="margin-left: auto;margin-right: auto;"
                class="col-12 col-sm-3 col-md-2 col-lg-2 col-xl-2 col-reset siguenos text-center">
                <a class="contact-fb" href="https://www.facebook.com/almacenes.oportunidades/" target="_blank"><span
                        class="text-contact" style="color:#b1b1b1">Síguenos </span> <i style="font-size: 40px;"
                        class="fab fa-facebook"></i></a>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand navbar-light bg-navbar">
        <div class="row w-100 d-flex align-items-center text-center row-reset">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row w-100 d-flex align-items-center text-center row-reset">
                    <div style="margin-left: auto;margin-right: auto;" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 col-reset">
                        <a href="/inicio"><span class="text-nav">Inicio</span></a>
                    </div>
                    <div style="margin-left: auto;margin-right: auto;" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 col-reset">
                        <a href="https://www.oportunidades.com.co/"><span class="text-nav">Crédito para Electrodomésticos </span></a>
                    </div>
                    <!-- <div style="margin-left: auto;margin-right: auto;" class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-reset">
                        <a href="index.php"><span class=" text-nav">Crédito por Libranza </span></a>
                    </div>-->
                </div>
            </div>
        </div>
    </nav>
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
    <!-- Modal política de tratamiento de datos -->
    <div class="modal fade bd-example-modal-lg" id="exampleModalScrollable2" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content bg-white">
                <div class="modal-header">
                    <h4 class="modal-title color-modal" id="exampleModalScrollableTitle">POLÍTICAS
                        DE TRATAMIENTO DE LA INFORMACIÓN <br> Y PROTECCIÓN DE DATOS PERSONALES</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="container">
                        <div id="peronalInformation" class="bg-white">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div style="max-width: 1200px;margin-left: auto;margin-right: auto;">
        <div class=" row-reset row contenedor">
            <div class="col-12">
                <div> <a class="btn btn-primary mt-4" href="/"> Regresar </a>
                </div>

            </div>
            <div class="col-12">
                <div class="card border-0 mb-5 mt-4 shadow">

                    <div class="card-body">
                        <h4 class="modal-title text-center color-modal" id="exampleModalScrollableTitle">POLÍTICAS
                            DE TRATAMIENTO DE LA INFORMACIÓN <br> Y PROTECCIÓN DE DATOS PERSONALES</h4>

                        <h2 class="menuItem-subtitle mt-3 color-modal">OBJETIVO:</h2>
                        <p class="mt-4 menuItem-text">
                            Establecer y divulgar las Políticas de Tratamiento de la
                            Información y Protección de Datos Personales, implementados por
                            LAGOBO DISTRIBUCIONES S.A.S L.G.B. S.A.S, con el fin de
                            garantizar el adecuado cumplimiento de la Ley 1581 de 2012 y el
                            Decreto 1377 de 2013, los cuales tienen por objeto desarrollar
                            el derecho constitucional que tienen todas las personas a
                            conocer, actualizar y rectificar las informaciones que se hayan
                            recogido sobre ellas en bases de datos o archivos, y los demás
                            derechos, libertades y garantías constitucionales a que se
                            refiere el artículo 15 de la Constitución Política “Habeas
                            Data”; así como el derecho a la información consagrado en el
                            artículo 20 de la misma.
                        </p>
                        <p class="mt-4 menuItem-text">
                            La sociedad LAGOBO DISTRIBUCIONES S.A.S L.G.B. S.A.S, adopta el
                            manual interno de políticas y procedimientos para garantizar el
                            cumplimiento de éste precepto y estas regulaciones normativas.
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">ALCANCE</h2>
                        <p class="mt-4 menuItem-text">
                            El presente documento aplica para los datos de carácter
                            personal, registrados en cualquier base de datos que administre
                            la compañía y que los haga susceptibles de Tratamiento.
                        </p>
                        <p class="mt-4 menuItem-text">
                            En ningún momento la filosofía del presente documento busca
                            reemplazar las buenas prácticas adoptadas por clientes,
                            proveedores, colaboradores y demás partes interesadas; por el
                            contrario, las políticas aquí definidas se adicionan a las
                            disposiciones de cualquier acuerdo y/o contrato legal, escrito
                            y/o verbal existente; y a su vez se hace de obligatorio
                            cumplimiento.
                        </p>
                        <p class="mt-4 menuItem-text">
                            LAGOBO DISTRIBUCIONES S.A.S, se reserva el derecho de verificar
                            y/o evaluar el cumplimiento de este código de ética, mediante
                            mecanismos y/o herramientas internas o externas a la compañía.
                            El incumplimiento de las políticas y directrices dadas en el
                            presente código de ética por parte de cualquier parte
                            interesada, puede conllevar a la terminación de cualquier
                            vínculo laboral y/o comercial.
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">DEFINICIONES</h2>
                        <p class="mt-4 menuItem-text">
                            Autorización: consentimiento previo, expreso e informado del
                            Titular para llevar a cabo el tratamiento de datos personales.
                            <br>
                            Base de datos: conjunto organizado de datos personales que sea
                            objeto de tratamiento. <br>
                            Causahabiente: persona que ha sucedido o se ha subrogado por
                            cualquier título en el derecho de otra u otras. <br>
                            Consultas: solicitud de la información personal del Titular que
                            repose en cualquier base de datos, sobre la cual tiene la
                            obligación LAGOBO DISTRIBUCIONES S.A.S L.G.B. S.A.S,
                            de suministrar al Titular o sus causahabientes, toda la
                            información contenida en el registro individual o que esté
                            vinculada con la identificación del Titular. <br>
                            Datos personales: cualquier información vinculada o que pueda
                            asociarse a una o varias personas naturales o jurídicas
                            determinadas o determinables. <br>
                            Dato público: es el dato que no sea semiprivado, privado o
                            sensible. Son considerados datos públicos, entre otros, los
                            datos relativos al estado civil de las personas, a su profesión
                            u oficio y a su calidad de comerciante o de servidor público.
                            Por su naturaleza, los datos públicos pueden estar contenidos,
                            entre otros, en registros púbicos, documentos públicos, gacetas
                            y boletines oficiales y sentencias judiciales debidamente
                            ejecutoriadas que no estén sometidas a reserva. <br>
                            Dato sensible: aquellos datos personales que revelen origen
                            racial o étnico, opiniones políticas, convicciones religiosas o
                            morales, afiliación sindical, información referente a la salud o
                            a la vida sexual o cualquier otro dato que pueda producir, por
                            su naturaleza o su contexto, algún trato discriminatorio al
                            titular de los datos.
                            Estos datos están especialmente protegidos.
                            <br>
                            Encargado del tratamiento: persona natural o jurídica, pública o
                            privada, que por sí misma o en asocio con otros, realice el
                            tratamiento de datos personales por cuenta del responsable del
                            mismo.
                            <br>
                            Habeas data: derecho fundamental que permite conocer, actualizar
                            y rectificar la información almacenada sobre las personas en
                            bancos de datos y en archivos de entidades públicas y privadas.
                            <br>
                            Reclamo: solicitud de corrección, actualización o supresión de
                            la información contenida en una base de datos tratada por LAGOBO
                            DISTRIBUCIONES S.A.S L.G.B. S.A.S, o solicitud por presunto
                            incumplimiento de cualquiera de los deberes contenidos en la Ley
                            1581 de 2012, realizada por el Titular o sus causahabientes.
                            <br>
                            Responsable del tratamiento: persona natural o jurídica, pública
                            o privada, que por sí misma o en asocio con otros, decida sobre
                            la base de datos y/o el tratamiento de éstos. <br>
                            Titular: persona natural o jurídica cuyos datos personales sean
                            objeto de tratamiento. <br>
                            Tratamiento: cualquier operación o conjunto de operaciones sobre
                            datos personales, tales como la recolección, almacenamiento,
                            uso, circulación o supresión.
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">LINEAMIENTOS GENERALES
                        </h2>
                        <p class="mt-4 menuItem-text">
                            5.1 Artículo 15 de la Constitución Política. “Todas las personas
                            tienen derecho a su intimidad personal y familiar y a su buen
                            nombre, y el Estado debe respetarlos y hacerlos respetar. De
                            igual modo, tienen derecho a conocer, actualizar y rectificar
                            las informaciones que se hayan recogido sobre ellas en bancos de
                            datos y en archivos de entidades públicas y privadas. En la
                            recolección, tratamiento y circulación de datos se respetarán la
                            libertad y demás garantías consagradas en la Constitución”. 5.2
                            Artículo 20 de la Constitución Política. “Se garantiza a toda
                            persona la libertad de expresar y difundir su pensamiento y
                            opiniones, la de informar y recibir información veraz e
                            imparcial, y la de fundar medios masivos de comunicación. Estos
                            son libres y tienen responsabilidad social. Se garantiza el
                            derecho a la rectificación en condiciones de equidad. No habrá
                            censura”.
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">LAGOBO DISTRIBUCIONES
                            S.A.S L.G.B. S.A.S EN LA NORMATIVIDAD</h2>
                        <p class="mt-4 menuItem-text">
                            Somos una fuente de información.
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">¿POR QUÉ SOMOS UNA FUENTE
                            DE INFORMACIÓN?</h2>
                        <p class="mt-4 menuItem-text">
                            Como quiera que LAGOBO DISTRIBUCIONES S.A.S L.G.B. S.A.S es una
                            sociedad que se encarga de recabar la información crediticia de
                            los usuarios a los que se les ofertan bienes mediante sistemas
                            de pago la modalidad crédito y contado, ésta constituye a las
                            denominadas fuentes de información de que tratan el literal (b)
                            del artículo tercero de la Ley 1266 del 2008. (…) “Es la
                            persona, entidad u organización que recibe o conoce datos
                            personales de los titulares de la información, en virtud de una
                            relación comercial o de servicio o de cualquier otra índole y
                            que, en razón de autorización legal o del titular, suministra
                            esos datos a un operador de información, el que a su vez los
                            entregará al usuario final. Si la fuente entrega la información
                            directamente a los usuarios y no, a través de un operador,
                            aquella tendrá la doble condición de fuente y operador y asumirá
                            los deberes y responsabilidades de ambos. La fuente de la
                            información responde por la calidad de los datos suministrados
                            al operador la cual, en cuanto tiene acceso y suministra
                            información personal de terceros, se sujeta al cumplimiento de
                            los deberes y responsabilidades previstas para garantizar la
                            protección de los derechos del titular de los datos”(…)
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">DEBERES DE LAS FUENTES DE
                            LA INFORMACIÓN ARTÍCULO 8, LEY 1266 DEL 2008</h2>
                        <p class="mt-4 menuItem-text">
                            Las fuentes de la información deberán cumplir las siguientes
                            obligaciones, sin perjuicio del cumplimiento de las demás
                            disposiciones previstas en la presente ley y en otras que rijan
                            su actividad: a. Garantizar que la información que se suministre
                            a los operadores de los bancos de datos o a los usuarios sea
                            veraz, completa, exacta, actualizada y comprobable. b. Reportar,
                            de forma periódica y oportuna al operador, todas las novedades
                            respecto de los datos que previamente le haya suministrado y
                            adoptar las demás medidas necesarias para que la información
                            suministrada a este se mantenga actualizada. c. Rectificar la
                            información cuando sea incorrecta e informar lo pertinente a los
                            operadores. d. Diseñar e implementar mecanismos eficaces para
                            reportar oportunamente la información al operador. e. Solicitar,
                            cuando sea del caso, y conservar copia o evidencia de la
                            respectiva autorización otorgada por los titulares de la
                            información, y asegurarse de no suministrar a los operadores
                            ningún dato cuyo suministro no esté previamente autorizado,
                            cuando dicha autorización sea necesaria, de conformidad con lo
                            previsto en la presente ley. f. Certificar, semestralmente al
                            operador, que la información suministrada cuenta con la
                            autorización de conformidad con lo previsto en la presente ley.
                            g. Resolver los reclamos y peticiones del titular en la forma en
                            que se regula en la presente ley. h. Informar al operador que
                            determinada información se encuentra en discusión por parte de
                            su titular, cuando se haya presentado la solicitud de
                            rectificación o actualización de la misma, con el fin de que el
                            operador incluya en el banco de datos una mención en ese sentido
                            hasta que se haya finalizado dicho trámite. i. Cumplir con las
                            instrucciones que imparta la autoridad de control en relación
                            con el cumplimiento de la presente ley. j. Los demás que se
                            deriven de la Constitución o de la presente ley. :
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">TRATAMIENTO DE DATOS PERSONALES</h2>
                        <p class="mt-4 menuItem-text2">
                            Principios para el tratamiento de datos personales
                        </p>
                        <p class="mt-4 menuItem-text">
                            Los siguientes principios serán tenidos en cuenta por LAGOBO
                            DISTRIBUCIONES S.A.S L.G.B. S.A.S, en el proceso de
                            administración de datos personales.
                        </p>
                        <p class="mt-4 menuItem-text2">
                            Legalidad en materia de tratamiento de datos: el tratamiento de
                            datos, debe sujetarse a las disposiciones contenidas en la Ley
                            1581 de 2012 y en cualquier norma que desarrolle o reglamente
                            tal disposición. <br> <br>
                            Finalidad y tratamiento: el tratamiento de datos debe obedecer a
                            una finalidad legítima de acuerdo con la Constitución y la Ley,
                            la cual debe ser informada al Titular.
                        </p>
                        <p class="mt-4 menuItem-text">
                            El tratamiento de datos y la finalidad de la información de las
                            bases de datos de LAGOBO DISTRIBUCIONES S.A.S L.G.B. S.A.S se
                            encuentran fundamentados en la prestación del servicio, la
                            relación contractual, los fines comerciales y/o publicitarios
                            LAGOBO DISTRIBUCIONES S.A.S L.G.B. S.A.S, podrá transmitir la
                            información a terceros, proveedores y autoridades. <br>
                            El tratamiento sólo puede ejercerse con el consentimiento,
                            previo, expreso e informado del Titular. Los datos personales no
                            podrán ser obtenidos o divulgados sin previa autorización, o en
                            ausencia de mandato legal o judicial que releve el
                            consentimiento.
                        </p>
                        <p class="mt-4 menuItem-text2">
                            Veracidad o calidad: la información sujeta a tratamiento debe
                            ser veraz, completa, exacta, actualizada, comprobable y
                            comprensible. Se prohíbe el tratamiento de datos parciales,
                            incompletos, fraccionados o que induzcan a error.
                            <br><br>
                            Transparencia: en el tratamiento debe garantizarse el derecho
                            del Titular a obtener por parte de LAGOBO DISTRIBUCIONES S.A.S
                            L.G.B. S.A.S, o del encargado del tratamiento, en cualquier
                            momento y sin restricciones, información acerca de la existencia
                            de datos que le conciernan de su interés o titularidad.
                            <br><br>
                            Acceso y circulación restringida: el tratamiento se sujeta a los
                            límites que se derivan de la naturaleza de los datos personales,
                            de las disposiciones de la Ley 1581 de 2012 y la Constitución.
                            En este sentido, el tratamiento sólo podrá hacerse por personas
                            autorizadas por el Titular y/o por las personas previstas en la
                            Ley.
                        </p>
                        <p class="mt-4 menuItem-text">
                            Los datos personales, salvo la información pública, no podrán
                            estar disponibles en Internet u otros medios de divulgación o
                            comunicación masiva, salvo que el acceso sea técnicamente
                            controlable para brindar un conocimiento restringido sólo a los
                            Titulares o terceros autorizados conforme a la Ley.
                        </p>
                        <div class="mt-4 menuItem-text2">
                            Seguridad: la información sujeta a tratamiento por el
                            responsable o encargado del tratamiento, se deberá manejar
                            tomando las medidas técnicas, humanas y administrativas que sean
                            razonables para otorgar seguridad a los registros procurando
                            evitar su adulteración, pérdida, consulta, uso o acceso no
                            autorizado o fraudulento.
                            <br><br>
                            Confidencialidad: todas las personas que intervengan en el
                            tratamiento de datos personales que no tengan la naturaleza de
                            públicos están obligadas a garantizar la reserva de la
                            información, inclusive después de finalizada su relación con
                            alguna de las labores que comprende dicho procedimiento,
                            pudiendo sólo realizar suministro o comunicación de datos
                            personales cuando ello corresponda al desarrollo de las
                            actividades autorizadas en la Ley y en los términos de la misma.
                        </div>
                        <p class="mt-4 menuItem-text2">
                            Categorías especiales de datos
                            <br><br>
                            Datos sensibles: son los datos que afectan la intimidad del
                            Titular o cuyo uso indebido puede generar su discriminación,
                            tales como aquellos que revelen el origen racial o étnico, la
                            orientación política, las convicciones religiosas o filosóficas,
                            la pertenencia a sindicatos, organizaciones sociales, de
                            derechos humanos o que promueva intereses de cualquier partido
                            político o que garanticen los derechos y garantías de partidos
                            políticos de oposición así como los datos relativos a la salud,
                            a la vida sexual y los datos biométricos.
                            <br><br>
                            Se prohíbe el tratamiento de datos sensibles, excepto cuando:
                        </p>
                        <p class="mt-4 menuItem-text">
                            El Titular haya dado su autorización explícita a dicho
                            tratamiento, salvo en los casos que por ley no sea requerido el
                            otorgamiento de dicha autorización.
                        </p>
                        <p class="mt-4 menuItem-text">
                            El tratamiento sea necesario para salvaguardar el interés vital
                            del Titular y este se encuentre física o jurídicamente
                            incapacitado. En estos eventos, los representantes legales
                            deberán otorgar su autorización.
                        </p>
                        <p class="mt-4 menuItem-text">
                            El tratamiento sea efectuado en el curso de las actividades
                            legítimas y con las debidas garantías por parte de una
                            fundación, ONG, asociación o cualquier otro organismo sin ánimo
                            de lucro, cuya finalidad sea política, filosófica, religiosa o
                            sindical, siempre que se refieran exclusivamente a sus miembros
                            o a las personas que mantengan contactos regulares por razón de
                            su finalidad. En estos eventos, los datos no se podrán
                            suministrar a terceros sin la autorización del Titular.
                        </p>
                        <p class="mt-4 menuItem-text">
                            El tratamiento se refiere a datos que son necesarios para el
                            reconocimiento, ejercicio o defensa de un derecho en un proceso
                            judicial.

                        </p>
                        <p class="mt-4 menuItem-text">
                            El tratamiento tiene una finalidad histórica, estadística o
                            científica. En este evento deberán adoptarse las medidas
                            conducentes a la supresión de identidad de los Titulares.

                        </p>
                        <p class="mt-4 menuItem-text">
                            En el tratamiento de datos personales sensibles, cuando dicho
                            tratamiento sea posible conforme a las excepciones citadas
                            anteriormente contenidas en el artículo 6 de la Ley 1581 de
                            2012, deberán cumplirse las siguientes obligaciones:
                        </p>
                        <p class="mt-4 menuItem-text">
                            Informar al Titular que por tratarse de datos sensibles no está
                            obligado a autorizar su tratamiento.
                        </p>
                        <p class="mt-4 menuItem-text">
                            Informar al Titular de forma explícita y previa, además de los
                            requisitos generales de la autorización para la recolección de
                            cualquier tipo de dato personal, cuáles de los datos que serán
                            objeto de tratamiento son sensibles y la finalidad del
                            Tratamiento, así como obtener su consentimiento expreso.
                        </p>
                        <p class="mt-4 menuItem-text2">
                            Derechos de los niños, niñas y adolescentes: en el tratamiento
                            se asegurará el respeto a los derechos prevalentes de los niños,
                            niñas y adolescentes.
                        </p>
                        <p class="mt-4 menuItem-text">
                            Queda proscrito el tratamiento de datos personales de niños,
                            niñas y adolescentes, salvo aquellos datos que sean de
                            naturaleza pública.
                        </p>
                        <p class="mt-4 menuItem-text2">
                            Derechos de los Titulares:
                        </p>
                        <p class="mt-4 menuItem-text2">
                            Conocer, actualizar y rectificar sus datos personales frente a
                            LAGOBO DISTRIBUCIONES S.A.S L.G.B. S.A.S, o frente al encargado
                            del tratamiento designado. Este derecho se podrá ejercer, entre
                            otros frente a datos parciales, inexactos, incompletos,
                            fraccionados, que induzcan a error, o aquellos cuyo tratamiento
                            esté expresamente prohibido o no haya sido autorizado.
                        </p>
                        <p class="mt-4 menuItem-text2">
                            Solicitar prueba de la autorización otorgada a LAGOBO
                            DISTRIBUCIONES S.A.S L.G.B. S.A.S, salvo cuando expresamente se
                            exceptúe como requisito para el tratamiento, de conformidad con
                            lo previsto en el artículo 10 de la Ley1581 de 2012.
                        </p>
                        <p class="mt-4 menuItem-text2">
                            Ser informado por parte de LAGOBO DISTRIBUCIONES S.A.S L.G.B.
                            S.A.S .o por parte del encargado del tratamiento designado,
                            previa solicitud, respecto del uso que le ha dado a sus datos
                            personales.
                        </p>
                        <p class="mt-4 menuItem-text2">
                            Presentar ante la Superintendencia de Industria y Comercio
                            quejas por infracciones a lo dispuesto en la Ley 1581 de 2012 y
                            las demás normas que la modifiquen, adicionen o complementen.
                        </p>
                        <p class="mt-4 menuItem-text2">
                            Revocar la autorización y/o solicitar la supresión del dato
                            cuando en el tratamiento no se respeten los principios, derechos
                            y garantías constitucionales y legales. La revocatoria y/o
                            supresión procederá cuando la Superintendencia de Industria y
                            Comercio haya determinado que en el tratamiento, LAGOBO
                            DISTRIBUCIONES S.A.S L.G.B. S.A.S, o el encargado designado, han
                            incurrido en conductas contrarias a Ley 1581 de 2012 ya la
                            Constitución.
                        </p>
                        <p class="mt-4 menuItem-text2">
                            Acceder en forma gratuita en las condiciones definidas en este
                            documento, a sus datos personales que hayan sido objeto de
                            tratamiento.
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">CONDICIONES PARA EL
                            TRATAMIENTO DE DATOS</h2>
                        <p class="mt-4 menuItem-text">
                            8.1 Autorización: en desarrollo de los principios de finalidad y
                            libertad, la recolección de los datos realizada por LAGOBO
                            DISTRIBUCIONES S.A.S L.G.B. S.A.S, deberá limitarse a aquellos
                            datos personales que son pertinentes y adecuados para la
                            finalidad para la cual son recolectados o requeridos conforme a
                            la normativa vigente, salvo en los casos expresamente previstos
                            en la Ley. 8.2 Autorización del Titular: para que LAGOBO
                            DISTRIBUCIONES S.A.S L.G.B. S.A.S realice cualquier acción de
                            tratamiento de datos personales, se requiere la autorización
                            previa e informada del Titular, la cual deberá ser obtenida por
                            cualquier medio que pueda ser objeto de consulta posterior.
                            Estos mecanismos podrán ser predeterminados a través de medios
                            técnicos que faciliten al Titular su manifestación automatizada
                            o pueden ser por escrito o de forma oral. Las autorizaciones por
                            parte de Titulares se registrarán así:
                        </p>
                        <p class="mt-4 menuItem-text">
                            LAGOBO DISTRIBUCIONES S.A.S L.G.B S.A.S, solicita autorización
                            para el tratamiento de la información a todos sus titulares,
                            siempre y cuando dicha recolección implique la realización de un
                            tratamiento de información por parte de LAGOBO DISTRIBUCIONES
                            S.A.S L.G.B S.A.S, o terceros (previa autorización), esta
                            solicitud de autorización se realiza al momento de generarse
                            relaciones comerciales con clientes (Ventas Crédito y Contado),
                            compra de productos y servicios con proveedores y contratación
                            de personal para el desempeño de las labores inherentes a la
                            organización. LAGOBO DISTRIBUCIONES S.A.S L.G.B S.A.S, adopta
                            los procedimientos para solicitar, a más tardar en el momento de
                            recolección de los datos, la autorización del Titular para el
                            tratamiento de los mismos e informará los datos personales que
                            serán recolectados así como todas las finalidades específicas
                            del dicho tratamiento para los cuales se obtiene el
                            consentimiento. Los datos personales que se encuentren en
                            fuentes de acceso público, con independencia del medio por el
                            cual se tenga acceso, entiéndase por tales aquellos datos o
                            bases de datos que se encuentren a disposición del público,
                            podrán ser tratados por LAGOBO DISTRIBUCIONES S.A.S L.G.B S.A.S,
                            siempre y cuando, por su naturaleza, sean datos públicos. En
                            caso de realizar cambios sustanciales en el contenido de las
                            Políticas del tratamiento, referidos a la identificación del
                            Responsable y a la Finalidad del tratamiento de los datos
                            personales, los cuales puedan afectar el contenido de la
                            autorización, LAGOBO DISTRIBUCIONES S.A.S L.G.B S.A.S,
                            comunicará estos cambios a los Titulares, como mínimo 3 días
                            antes de la entrada en vigencia de la nueva política, además
                            obtendrá del Titular una nueva autorización cuando el cambio se
                            refiera a la Finalidad del Tratamiento. Para la comunicación de
                            los cambios y la autorización.
                        </p>
                        <h3 class="menuItem-subtitle mt-3 color-modal">Casos en que no es
                            necesaria la autorización</h3>
                        <p class="mt-4 menuItem-text2">
                            Información requerida por una entidad pública o administrativa
                            en ejercicio de sus funciones legales o por orden judicial.
                            <br><br>
                            Datos de naturaleza pública.
                            <br><br>
                            Casos de urgencia médica o sanitaria.
                            <br><br>
                            Tratamiento de información autorizado por la ley para fines
                            históricos, estadísticos o científicos.
                            <br><br>
                            Datos relacionados con el Registro Civil de las personas.
                        </p>
                        <p class="mt-4 menuItem-text">
                            <span style="text-decoration:underline">Suministro de la
                                información:</span>la información solicitada al Titular será
                            suministrada a LAGOBO DISTRIBUCIONES S.A.S L.G.B S.Apor
                            cualquier medio; incluyendo los electrónicos, según lo requiera
                            el Titular. La información deberá ser de fácil lectura, sin
                            barreras técnicas que impidan su acceso y deberá corresponder en
                            un todo a aquella que repose en la base de datos.
                            <br>
                            <span style="text-decoration:underline">Deber de informar al
                                Titular: </span> LAGOBO DISTRIBUCIONES S.A.S L.G.B S.A.S, al
                            momento de solicitar al Titular la autorización, deberá
                            informarle de manera clara y expresa lo siguiente:
                        </p>
                        <p class="mt-4 menuItem-text">
                            El tratamiento al cual serán sometidos sus datos personales y la
                            finalidad del mismo.
                            <br>
                            El carácter facultativo de la respuesta a las preguntas que le
                            sean hechas, cuando estas traten sobre datos sensibles o sobre
                            los datos de las niñas, niños y adolescentes.
                            <br>
                            Los derechos que le asisten como Titular.
                            <br>
                            La identificación, dirección física o electrónica y teléfono del
                            responsable del tratamiento.
                        </p>
                        <p class="mt-4 menuItem-text">
                            <span style="text-decoration:underline">Personas a quienes se
                                les puede suministrar la información</span>:la información
                            acerca de los datos personales que hayan sido materia de
                            Tratamiento por parte de LAGOBO DISTRIBUCIONES S.A.S L.G.B
                            S.A.S, podrá suministrarse a las siguientes personas:
                        </p>
                        <p class="mt-4 menuItem-text">
                            A los Titulares, sus causahabientes o sus representantes
                            legales.
                            <br>
                            A las entidades públicas o administrativas en ejercicio de sus
                            funciones legales o por orden judicial.
                            <br>
                            A los terceros autorizados por el Titular o por la ley.
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">DERECHOS DEL TITULAR</h2>
                        <p class="mt-4 menuItem-text2">
                            <span style="text-decoration:underline">Revocatoria de la
                                autorización y/o supresión del dato:</span>
                        </p>
                        <p class="mt-4 menuItem-text">
                            Los Titulares podrán en todo momento solicitar a LAGOBO
                            DISTRIBUCIONES S.A.S L.G.B S.A.S, la supresión de sus datos
                            personales y/o revocar la autorización otorgada para el
                            tratamiento de los mismos, mediante la presentación de un
                            reclamo, de acuerdo con lo establecido en el artículo 15 de la
                            Ley 1581 de 2012.
                        </p>
                        <p class="mt-4 menuItem-text">
                            La solicitud de supresión de la información y la revocatoria de
                            la autorización NO PROCEDERÁN CUANDO EL TITULAR TENGA UN DEBER
                            LEGAL O CONTRACTUAL DE PERMANECER EN LA BASE DE DATOS DE LAGOBO
                            DISTRIBUCIONES S.A.S L.G.B S.A.S
                        </p>
                        <p class="mt-4 menuItem-text">
                            El procedimiento será el establecido en el presente documento
                            para presentar reclamos.
                        </p>
                        <p class="mt-4 menuItem-text2">
                            <span style="text-decoration:underline">Consultas y
                                reclamos</span> :el Titular o sus causahabientes tienen
                            derecho a presentar ante LAGOBO DISTRIBUCIONES S.A.S L.G.B
                            S.A.S, consultas y/o reclamos, previa validación de su
                            identidad, a través de cualquiera de los siguientes mecanismos,
                            de atención al usuario dispuestos por la Compañía a nivel
                            nacional.
                        </p>
                        <p class="mt-4 menuItem-text2">
                            LAGOBO DISTRIBUCIONES S.A.S L.G.B S.A.S, responderá la consulta
                            y/o reclamo por el mismo medio que fue formulada.
                        </p>
                        <p class="mt-4 menuItem-text">
                            Consulta:
                        </p>
                        <p class="mt-4 menuItem-text">
                            Los Titulares o sus causahabientes podrán consultar la
                            información personal del Titular que repose en la base de datos
                            del responsable. LAGOBO DISTRIBUCIONES S.A.S L.G.B S.A.S
                            suministrará al solicitante toda la información contenida en el
                            registro individual o que esté vinculada con la identificación
                            del Titular.
                        </p>
                        <p class="mt-4 menuItem-text">
                            <span style="text-decoration:underline">El Titular podrá
                                consultar de forma gratuita sus datos personales:</span>
                        </p>
                        <p class="mt-4 menuItem-text">
                            Al menos una (1) vez cada mes calendario.
                            <br>
                            Cada vez que existan modificaciones sustanciales de las
                            Políticas de Tratamiento de la Información, que motiven nuevas
                            consultas.
                            <br>
                            Para consultas cuya periodicidad sea mayor a una (1) por cada
                            mes calendario, LAGOBO DISTRIBUCIONES S.A.S L.G.B S.A.S,
                            solamente cobrará los gastos de envío, reproducción y en su
                            caso, certificación de documentos. Los costos de reproducción no
                            podrán ser mayores a los costos de recuperación del material
                            correspondiente.
                        </p>
                        <p class="mt-4 menuItem-text">
                            <span style="text-decoration:underline">Respuesta a
                                consultas</span>
                        </p>
                        <p class="mt-4 menuItem-text">
                            Para efectos de responder las consultas, LAGOBO DISTRIBUCIONES
                            S.A.S L.G.B S.A.S, cuenta con un término de diez (10) días
                            hábiles contados a partir de la fecha de recibo de las mismas.
                            <br>
                            Cuando no fuere posible atender la consulta dentro de dicho
                            término, se informará al interesado, expresando los motivos de
                            la demora y señalando la fecha en que se atenderá su consulta,
                            la cual en ningún caso podrá superar los cinco (5) días hábiles
                            siguientes al vencimiento del primer término.
                        </p>
                        <p class="mt-4 menuItem-text">
                            Reclamos:
                        </p>
                        <p class="mt-4 menuItem-text">
                            El Titular o sus causahabientes que consideren que la
                            información contenida en una base de datos debe ser objeto de
                            corrección, actualización o supresión, o cuando adviertan el
                            presunto incumplimiento de cualquiera de los deberes contenidos
                            en la Ley 1581 de 2012, podrán presentar un reclamo ante LAGOBO
                            DISTRIBUCIONES S.A.S L.G.B S.A.S, el cual será tramitado bajo
                            las siguientes reglas y se formulará mediante solicitud dirigida
                            a LAGOBO DISTRIBUCIONES S.A.S L.G.B S.A.S, como mínimo con la
                            siguiente información:
                        </p>
                        <p class="mt-4 menuItem-text">
                            Nombre del responsable del Tratamiento o el encargado del mismo.
                            <br>
                            Nombre del peticionario.
                            <br>
                            Número de identificación del peticionario.
                            <br>
                            Hechos en que se fundamenta la solicitud.
                            <br>
                            Objeto de la petición.
                            <br>
                            Dirección de envío de correspondencia.
                            <br>
                            Aportar los documentos que pretenda hacer valer.
                        </p>
                        <p class="mt-4 menuItem-text">
                            Si el reclamo resulta incompleto, se requerirá al interesado
                            dentro de los cinco (5) días siguientes a la recepción del
                            reclamo para que subsane las fallas. Transcurridos dos (2) meses
                            desde la fecha del requerimiento, sin que el solicitante
                            presente la información requerida, se entenderá que ha desistido
                            del reclamo.
                            En caso de que quien reciba el reclamo no sea competente para
                            resolverlo, dará traslado a quien corresponda en un término
                            máximo de dos (2) días hábiles e informará de la situación al
                            interesado.
                            <br>
                            Una vez recibido el reclamo completo, se incluirá en la base de
                            datos una leyenda que diga ;reclamo en trámite; y el motivo del
                            mismo, en un término no mayor a dos (2) días hábiles. Dicha
                            leyenda deberá mantenerse hasta que el reclamo sea resuelto.
                            <br>
                            El término máximo para atender el reclamo será de quince (15)
                            días hábiles contados a partir del día siguiente a la fecha de
                            su recibo. Cuando no fuere posible atender el reclamo dentro de
                            dicho término, se informará al interesado los motivos de la
                            demora y la fecha en que se atenderá su reclamo, la cual en
                            ningún caso podrá superar los ocho (8) días hábiles siguientes
                            al vencimiento del primer término.
                        </p>
                        <p class="mt-4 menuItem-text">
                            Requisito de procedibilidad:
                        </p>
                        <p class="mt-4 menuItem-text">
                            El Titular o causahabiente sólo podrá elevar queja ante la
                            Superintendencia de Industria y Comercio una vez haya agotado el
                            trámite de consulta o reclamo ante el responsable del
                            tratamiento o encargado del mismo.
                        </p>
                        <p class="mt-4 menuItem-text">
                            Procedimiento para consultas y reclamos.
                        </p>
                        <p class="mt-4 menuItem-text">
                            Dando cumplimiento a lo anterior LAGOBO DISTRIBUCIONES S.A.S
                            L.G.B S.A.S, responderá la consulta y/o reclamo por el mismo
                            medio que fue formulada.
                        </p>
                        <p class="mt-4 menuItem-text">
                            El procedimiento establecido por LAGOBO DISTRIBUCIONES S.A.S
                            L.G.B S.A.S para presentar reclamos, hacer consultas y/o ejercer
                            sus derechos como titular de la información recogida es el
                            siguiente:
                        </p>
                        <p class="mt-4 menuItem-text">
                            Recepción del reclamo o consulta en cualquiera de las sucursales
                            del país, estas podrán ser identificadas en la página Web
                            www.oportunidades.com.co, también podrán dirigir escrito
                            directamente a las Oficinas administrativas en la ciudad de
                            Pereira, a la dirección Carrera 8 Numero 20 – 53, departamento
                            jurídico.
                            También se podrán enviar reclamos o consultas a través de correo
                            electrónico: notificaciones@lagobo.com.co, de conformidad con el
                            Numeral Segundo, Literal Segundo, ARTÍCULO 16 Ley 1266 del
                            2008-Numeral Segundo, Artículo 15, Ley 1581 del 2012. <br>
                            Para peticiones o consultas, se cuenta con 10 días hábiles a
                            partir de la recepción, de ser necesario se podrá extender la
                            respuesta 5 días hábiles más.
                            Para reclamos, se cuenta con 15 días hábiles para resolver el
                            mismo, Numeral tercero del artículo 16 de la ley 1266 del 2008.
                        </p>
                        <p class="mt-4 menuItem-text">
                            Excepcionalmente se cuenta con 8 días hábiles adicionales a los
                            primeros 15, para dar respuesta al derecho de petición, siempre
                            y cuando se notifique a quien realiza el derecho de petición.
                            <br>
                            LAGOBO DISTRIBUCIONES S.A.S dentro de los 2 días hábiles
                            siguientes a la recepción del reclamo impondrá en la base de
                            datos del operador la constancia o leyenda de que se encuentra
                            ;reclamo en trámite;.
                            En caso de no ser competentes, se cuenta con 2 días hábiles para
                            trasladar la información a la entidad competente.
                            Una vez se cuente con la respuesta a la consulta o reclamo
                            elevado por el cliente, se enviará a la dirección que aportó en
                            la solicitud y o al medio por el cual realizó la consulta.
                            <br>
                            En caso de dudas o inquietudes sobre el procedimiento para
                            presentar reclamos, hacer consultas y/o ejercer sus derechos
                            como titular de los datos recogidos por LAGOBO DISTRIBUCIONES
                            S.A.S L.G.B S.A.S, se podrá solicitar información general a
                            través del departamento de Servicio al Cliente por medio de la
                            línea 018000117787 opción 1, y al correo electrónico
                            servicioalcliente@lagobo.com
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">DEBERES DE LAGOBO
                            DISTRIBUCIONES S.A.S L.G.B S.A.S, EN EL TRATAMIENTO DE DATOS
                        </h2>
                        <p class="mt-4 menuItem-text2">
                            Garantizar al Titular, en todo tiempo, el pleno y efectivo
                            ejercicio del derecho de hábeas data.
                            <br><br>
                            Solicitar y conservar, en las condiciones previstas en la Ley,
                            copia de la respectiva autorización otorgada por el Titular.
                            <br><br>
                            Informar debidamente al Titular sobre la finalidad de la
                            recolección y los derechos que le asisten por virtud de la
                            autorización otorgada.
                            <br><br>
                            Tomar las medidas orientadas a conservar la información bajo las
                            condiciones de seguridad para impedir su adulteración, pérdida,
                            consulta, uso o acceso no autorizado o fraudulento.
                            <br><br>
                            Propender porque la información que se suministre al encargado
                            del tratamiento sea veraz, completa, exacta, actualizada,
                            comprobable y comprensible.
                            <br><br>
                            Actualizar la información, comunicando de forma oportuna al
                            encargado del tratamiento, todas las novedades respecto de los
                            datos que previamente le haya suministrado y adoptar las demás
                            medidas necesarias para que la información suministrada a este
                            se mantenga actualizada.
                            <br><br>
                            Rectificar la información cuando sea incorrecta y comunicar lo
                            pertinente al encargado del tratamiento.
                            <br><br>
                            Suministrar al encargado del tratamiento, según el caso,
                            únicamente datos cuyo tratamiento esté previamente autorizado de
                            conformidad con lo previsto en la Ley.
                            <br><br>
                            Exigir al encargado del tratamiento en todo momento, el respeto
                            a las condiciones de seguridad y privacidad de la información
                            del Titular.
                            <br><br>
                            Tramitar las consultas y reclamos formulados en los términos
                            señalados en la ley.
                            <br><br>
                            Adoptar un manual interno de políticas y procedimientos para
                            garantizar el adecuado cumplimiento de la presente ley y en
                            especial, para la atención de consultas y reclamos.
                            <br><br>
                            Informar al encargado del tratamiento cuando determinada
                            información se encuentra en discusión por parte del Titular, una
                            vez se haya presentado la reclamación y no haya finalizado el
                            trámite respectivo.
                            <br><br>
                            Informar a solicitud del Titular sobre el uso dado a sus datos.
                            <br><br>
                            Informar a la autoridad de protección de datos cuando se
                            presenten violaciones a los códigos de seguridad y existan
                            riesgos en la administración de la información de los Titulares.
                            <br><br>
                            Cumplir las instrucciones y requerimientos que imparta la
                            Superintendencia de Industria y Comercio.
                            <br><br>
                            Deberes del encargado del tratamiento de datos:
                            <br><br>
                            Los encargados del tratamiento deberán cumplir los siguientes
                            deberes, sin perjuicio de las demás disposiciones previstas en
                            la Ley y en otras que rijan su actividad:
                            <br><br>
                            Garantizar al Titular, en todo tiempo, el pleno y efectivo
                            ejercicio del derecho de hábeas data.
                            <br><br>
                            Tomar las medidas para conservar la información bajo las
                            condiciones de seguridad necesarias para impedir su
                            adulteración, pérdida, consulta, uso o acceso no autorizado o
                            fraudulento.
                            <br><br>
                            Realizar oportunamente la actualización, rectificación o
                            supresión de los datos en los términos de la presente ley.
                            <br><br>
                            Actualizar la información reportada por los responsables del
                            tratamiento dentro de los cinco (5) días hábiles contados a
                            partir de su recibo.
                            <br><br>
                            Tramitar las consultas y los reclamos formulados por los
                            Titulares en los términos señalados en la Ley.
                            <br><br>
                            Adoptar un documento que garantice el adecuado cumplimiento de
                            la Ley y, en especial, para la atención de consultas y reclamos
                            por parte de los Titulares.
                            <br><br>
                            Registrar en la base de datos las leyenda ;reclamo en trámite;
                            en la forma en que se regula en la Ley.
                            <br><br>
                            Insertar en la base de datos la leyenda ;información en
                            discusión judicial; una vez notificado por parte de la autoridad
                            competente sobre procesos judiciales relacionados con la calidad
                            del dato personal.
                            <br><br>
                            Abstenerse de circular información que esté siendo controvertida
                            por el Titular y cuyo bloqueo haya sido ordenado por la
                            Superintendencia de Industria y Comercio.
                            Permitir el acceso a la información únicamente a las personas
                            que pueden tener acceso a ella.
                            <br><br>
                            Informar a la Superintendencia de Industria y Comercio cuando se
                            presenten violaciones a los códigos de seguridad y existan
                            riesgos en la administración de la información de los Titulares.
                            <br><br>
                            Cumplir las instrucciones y requerimientos que imparta la
                            Superintendencia de Industria y Comercio.
                            <br><br>
                            Salvaguardar las bases de datos en los que se contengan datos
                            personales.
                            <br><br>
                            Guardar confidencialidad respecto del Tratamiento de los datos
                            personales.
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">11. MEDIDAS DE SEGURIDAD
                        </h2>
                        <p class="mt-4 menuItem-text">
                            LAGOBO DISTRIBUCIONES S.A.S a partir de la declaración y
                            publicación de su CÓDIGO DE ÉTICA Y BUEN GOBIERNO CORPORATIVO,
                            como muestra de su compromiso con la actuación bajo sanas y
                            buenas prácticas, espera que todos los integrantes
                            pertenecientes a su grupo de interés y todos aquellos con
                            quienes continuamente desarrolla actividades de relacionamiento,
                            apliquen y cumplan estas mismas políticas y prácticas que buscan
                            garantizar un desarrollo Humano, financiero, de infraestructura
                            y del conocimiento sano y con potencial de mejora continua.
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">12. MODIFICACIONES</h2>
                        <p class="mt-4 menuItem-text2">
                            - Reglamento Interno de Trabajo.
                            - Manual de calidad.
                            - Manual de Proveedores.
                            - Aceptación código de ética y SARLAFT.
                        </p>
                        <h2 class="menuItem-subtitle mt-3 color-modal">13. FORMATOS QUE SE
                            UTILIZAN</h2>
                        <p class="mt-4 menuItem-text2">
                            - Se resuelve adoptar el código de ética y buen gobierno de
                            LAGOBO DISTRIBUCIONES S.A.S por parte de todos sus
                            colaboradores.
                            <br><br>
                            - El Código de Ética y Buen Gobierno que se adopta debe ser
                            divulgado y socializado a cada colaborador y parte interesada a
                            la compañía. Será publicado en las páginas WEB de la compañía e
                            Intranet para conocimiento de todas las partes relacionadas.
                            <br><br>
                            - El cumplimiento de código de ética será objetivo de constante
                            seguimiento por parte de LAGOBO DISTRIBUCIONES S.A.S
                            <br><br>
                            - Las políticas definidas a proveedores y colaboradores podrán
                            ser evaluadas por LAGOBO en cualquier momento
                        </p>

                        <a class="btn btn-primary mt-4" href="/"> Regresar </a>

                    </div>

                </div>
            </div>
        </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/jqueryMigrate.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/ciudades.js"></script>
<script type="text/javascript">
    // 1. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 2. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.
    var player;

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

    function onPlayerStateChange(event) {

    }

    function stopVideo() {
        player.stopVideo();
    }
    /*
    setTimeout(function(){
    	$('#modalAgradacimiento').modal('show');
    }, 30000);
    setTimeout(function(){
    	$('#modalAgradacimiento').modal('hide');
    }, 48000);
    */
</script>

</html>