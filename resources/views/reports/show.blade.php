<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura de compra</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
-->
    <div class="container">
        <div class="justify-content-center">
            <h2>
                Order generada N# {{$factura->id}}
            </h2>
            <h6>
                {{$factura->created_at}}
                <div class="clearfix">
                    <div>Empresa</div>
                    <div>xxxx</div>
                    <div>NIT 98764553, <br> Codigo 123000000083736</div>
                    <div>xxxx@gmail.com</div>
                </div>
            </h6>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="card-header ">Detalle del usuario</div>
                    <table class="table table-sm">
                        <tr>
                            <th>Nombre</th>
                            <td>{{$factura->user->name}}</td>
                        </tr>
                        <tr>
                            <th>Telefono</th>
                            <td>{{$factura->user->phone}}</td>
                        </tr>
                        <tr>
                            <th>Celular</th>
                            <td>{{$factura->user->cellphone}}</td>
                        </tr>
                        <tr>
                            <th>Correo</th>
                            <td>{{$factura->user->email}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card-body">
                    <div class="card-header ">Detalle Fctura</div>
                    <table class="table table-sm">
                        <tr>
                            <th>#</th>
                            <td>{{$factura->id}}</td>
                        </tr>
                        <tr>
                            <th>Total de la orden</th>
                            <td>$.{{number_format($factura->total)}}</td>
                        </tr>
                        <tr>
                            <th>Estatus de la orden </th>
                            <td>{{$factura->status}}</td>
                        </tr>
                        <tr>
                            <th>Estado del pago</th>
                            <td>{{$factura->payment->status}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-10">
                <div class="card-body">
                    <div class="card-header ">Detalle de la compra</div>
                    <table class="table">
                        <thead>
                        @foreach($factura->details as $detail)
                            <tr>
                                <th>Nombre</th>
                                <th>talla</th>
                                <th>color</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        <thead>
                        <tr>
                            <th class="v-align-middle">
                                {{ $detail->product->name}}
                            </th>
                            <th class="v-align-middle">
                                {{ $detail->size->name}}
                            </th>
                            <th class="v-align-middle">
                                {{ $detail->color->name}}
                            </th>
                            <th class="v-align-middle">
                                {{ $detail->stock}}U
                            </th>
                            <th class="v-align-middle">
                                $.{{ number_format($detail->total) }}
                            </th>
                        </tr>
                        @endforeach
                        </thead>
                    </table>
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

