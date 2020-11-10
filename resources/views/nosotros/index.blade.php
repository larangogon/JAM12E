<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tiendas JAM</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="{{asset('js/app.js') }}" defer></script>

    <link href="{{mix('css/app.css') }}" rel="stylesheet">
    <style type="text/css">

        .bg-darkb{
            background: black;
        }

        .body {
            background:url(dist/img/galactic_outflows_410_410.jpg);
            color:black ;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
    </style>
</head>
<body class="body">
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="media">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card text-white bg-darkb">
                            <div class="card-body">
                                <div>
                                    <h5>
                                        MISION:
                                    </h5>
                                    <p class="text"> En JAM, entregamos siempre a tiempo diseños exclusivos,
                                        impactantes, con la mejor calidad y actuales.
                                        Frabricamos con amor y pasión para que nuestros clientes puedan
                                        llevar prendas exclusivas!!
                                    </p>
                                </div>

                                <div>
                                    <h5>
                                        VISION:
                                    </h5>
                                    <p class="text">Como familia, lograremos el crecimiento de una empresa
                                        solida y rentable, ofreciendo los productos esperados por el mercado.
                                    </p>
                                </div>

                                <div>
                                    <h5>
                                        VALORES:
                                    </h5>
                                    <p class="text"> 1.- La honestidad. <br>
                                        2.- La excelencia en el servicio.<br>
                                        3.- El mejoramiento continuo.<br>
                                        4.- El trabajo en equipo o gestión participativa.<br>
                                        5.- La responsabilidad por los actos propios.<br>
                                        6.- Rendimiento<br>
                                        7.- Pasión<br>
                                        8.- Integridad<br>
                                        9.- Diversidad
                                    </p>
                                </div>
                                <h5>
                                    <a href="{{ url('vitrina') }}">
                                        <button type="button" class="btn btn-dark btn-sm btn-block">Volver
                                        </button>
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div>
                            <img src="dist/img/descarga (1).png"class="brand-image img-circle elevation-3"
                                 style="opacity: .8">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('layouts.footer')
</html>
