<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Reporte general</h2>
        <div class="justify-content-center">
            <h6>
                <div class="clearfix">
                    <div>Empresa</div>
                    <div>xxxx</div>
                    <div>NIT 98764553, <br> Codigo 123000000083736</div>
                    <div>xxxx@gmail.com</div>
                </div>
            </h6>
            <div class="card-deck">
                <div class="card text-white bg-dark mb-2" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Consumo</h5>
                        <p class="card-text"> Se han registrado {{$users}} usuarios hasta la fecha</p>
                        <p class="card-text">Hata la fecha se ha cancelado {{$cancelled}} pagos</p>
                        <p class="card-text">Este año se han  creado  {{$products}} productos</p>
                    </div>
                </div>
                <div class="card text-white bg-primary mb-2" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Consumo</h5>
                        <p class="card-text"> Hoy se ha agregado {{$hoy}} nuevas ordenes</p>
                        <p class="card-text">Hoy se ejecutaron {{$pay}} pagos.</p>
                        <p class="card-text">Hasta la fecha se han actualizado {{$payments}} pagos</p>
                    </div>
                </div>
                <div class="card text-white bg-success mb-2" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Productos mas vendidos</h5>
                        <p class="card-text">
                        @foreach($sales as $product)
                            <table class="table table-sm">
                                <tbody>
                                <tr>
                                    <th scope="col">Id</th>
                                    <td>{{$product->id}}</td>
                                    <th scope="col"></th>
                                    <td>{{$product->name}}</td>
                                    <th scope="col"></th>
                                    <td>{{$product->sales}}</td>
                                </tr>
                                </tbody>
                            </table>
                            @endforeach
                            </p>
                    </div>
                </div>
                <div class="card text-white bg-danger mb-2" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Productos mas vistos</h5>
                        <p class="card-text">
                        @foreach($visit as $product)
                            <table class="table table-sm">
                                <tbody>
                                <tr>
                                    <th scope="col">Id</th>
                                    <td>{{$product->id}}</td>
                                    <th scope="col"></th>
                                    <td>{{$product->name}}</td>
                                    <th scope="col"></th>
                                    <td>{{$product->visits}}</td>
                                </tr>
                                </tbody>
                            </table>
                            @endforeach
                            </p>
                    </div>
                </div>
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
</body>
</html>
