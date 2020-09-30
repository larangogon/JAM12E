@extends('layouts.app')

@section('content')

<!-- Styles -->
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
      .content-wrapper{
        background:url(dist/img/c4cd43c7-155f-47d9-b41d-5c8029047a08.jpg);
        background-size: cover;
        padding-bottom: 80em;
        background-repeat: no-repeat;
        width: 100%;
        height: 100vh;
        color: white;


      }
    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="container">
    <div class="content-box-large">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-9">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
