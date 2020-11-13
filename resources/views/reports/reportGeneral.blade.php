<!DOCTYPE html>
<html lang="es">
<head>
    <style>
        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            margin: 3cm 2cm 2cm;
        }

        main{
            margin: 3cm 2cm 2cm;
        }

         hr{
             page-break-after: always;
             border: none;
             margin: 0;
             padding: 0;
         }


        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 3cm;
            background-color: #2a0927;
            color: white;
            text-align: center;
            line-height: 30px;
         }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<header>
    <div class="container">
        <h6>
            <div class="clearfix">
                <div>Empresa</div>
                <div>NIT 98764553, <br> Codigo 123000000083736</div>
                <div>xxxx@gmail.com</div>
            </div>
        </h6>
    </div>
</header>
<main>
    <div class="container">
        <br>
        <br>
        <h2>Resumen general</h2>
        <p>Ver con mas detalle en archivo general excel</p>
        <h6><div>{{$now->format("F j, Y, g:i a")}}</div></h6>

        <h5 class="card-title">Consumo</h5>
        <br>
        <table class="table table-sm">
            <tr>
                <th>Pagos cancelados hasta la fecha</th>
                <td>{{$cancelled}}</td>
            </tr>
            <tr>
                <th>Ordenes generadas el dia de hoy</th>
                <td>{{$hoy}}</td>
            </tr>
            <tr>
                <th>Pagos generados el dia de hoy</th>
                <td>{{$pay ?? __('no existe')}}</td>
            </tr>
            <tr>
                <th>Pagos actualizados el dia de hoy</th>
                <td>{{$payments ?? __('no existe')}}</td>
            </tr>
            <tr>
                <th>El valor de la factura mas alto es de</th>
                <td>$.{{$price ?? __('no existe')}}</td>
            </tr>
            <tr>
                <th>Cantidad de ordenes aprovadas hasta hoy</th>
                <td>{{$approved ?? __('no existe')}}</td>
            </tr>
            <tr>
                <th>Cantidad de ordenes rechazadas hasta hoy</th>
                <td>{{$rejected ?? __('no existe')}}</td>
            </tr>
            <tr>
                <th>El total de todas las ordenes hasta hoy, es por un valor de </th>
                <td>$.{{$order->sum('total') ?? __('no existe')}}</td>
            </tr>
            <tr>
                <th>La suma total de las facturas aprovadas hasta hoy, es por un valor de </th>
                <td>$.{{$sum ?? __('no existe')}}</td>
            </tr>
            <tr>
                <th>La suma total de las facturas rechazadas hasta hoy, es por un valor de </th>
                <td>$.{{$sumRechazada ?? __('no existe')}}</td>
            </tr>
            <tr>
                <th>La suma total de las facturas pendientes hasta hoy, es por un valor de </th>
                <td>$.{{$sumPending ?? __('no existe')}}</td>
            </tr>
        </table>
        <br>


        <hr> <!-- Salto de página -->

        <br><br><br><br><br><br><br><br>
        <h5 class="card-title">Genaral</h5>
        <br>
        <table class="table table-sm">
            <tr>
                <th>Cantidad de usuarios registrados hasta hoy {{$now->format("F j, Y, g:i a")}}</th>
                <td>{{$users ?? __('no existe')}}</td>
            </tr>
            <tr>
                <th>La suma total de los votos obtenidos por todos los productos es de </th>
                <td>{{$ratinAllProducs ?? __('no existe')}}</td>
            </tr>
            <tr>
                <th>Cantidad de productos creados hasta hoy</th>
                <td>{{$products ?? __('no existe')}}</td>
            </tr>
        </table>
        <br>
        <br>

        <h5>* Los 4 productos mas vendidos hasta {{$now->format("F j, Y, g:i a")}}</h5>
        <div class="row">
            <div class="col-sm-8">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">nombre</th>
                        <th scope="col">cantidad de compras</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $product)
                    <tr>
                        <th scope="row">{{$product->id ?? __('no existe')}}</th>
                        <td>{{$product->name ?? __('no existe')}}</td>
                        <td>{{$product->sales ?? __('no existe')}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <hr> <!-- Salto de página -->

        <br><br><br><br><br><br><br><br>
        <h5>* Los 4 productos mas vistos hasta {{$now->format("F j, Y, g:i a")}}</h5>
        <div class="row">
            <div class="col-sm-8">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">nombre</th>
                        <th scope="col">cantidad de visitas</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($visit as $product)
                        <tr>
                            <th scope="row">{{$product->id ?? __('no existe')}}</th>
                            <td>{{$product->name ?? __('no existe')}}</td>
                            <td>{{$product->visits ?? __('no existe')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <br>
        <br>
        <h5>* Los 4 productos mejor calificados hasta {{$now->format("F j, Y, g:i a")}}</h5>
        <div class="row">
            <div class="col-sm-8">
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">nombre</th>
                        <th scope="col">cantidad de votos</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rating as $product)
                        <tr>
                            <th scope="row">{{$product->rateable->id ?? __('no existe')}}</th>
                            <td>{{$product->rateable->name ?? __('no existe')}}</td>
                            <td>{{$product->score ?? __('no existe')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <script type="text/php">
            if ( isset($pdf) ) {
                $pdf->page_script('
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $pdf->text(270, 780, "Pág $PAGE_NUM de $PAGE_COUNT", $font, 10);
                ');
            }
        </script>
</main>
</body>
</html>
