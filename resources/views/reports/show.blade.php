<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura de compra</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link href="{{mix('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
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
        <br>
        <br>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-sm">
                    <tr>
                        <th>Vendedor</th>
                        <td>{{$factura->user->name}}</td>
                    </tr>
                    <tr>
                        <th>Telefono</th>
                        <td>{{$factura->user->phone}}</td>
                    </tr>
                    <tr>
                        <th>Total de la orden</th>
                        <td>$.{{number_format($factura->total)}}</td>
                    </tr>
                    <tr>
                        <th>Pagador </th>
                        <td>{{$factura->payment->name}}</td>
                    </tr>
                    <tr>
                        <th>Celular</th>
                        <td>{{$factura->payment->mobile}}</td>
                    </tr>
                    <tr>
                        <th>Correo</th>
                        <td>{{$factura->payment->email}}</td>
                    </tr>
                    <tr>
                        <th>Documento </th>
                        <td>{{$factura->payment->document}}</td>
                    </tr>
                    <tr>
                        <th>Estado del pago</th>
                        <td>{{$factura->payment->status}}</td>
                    </tr>
                    @if($factura->status == 'APPROVED')
                    <tr>
                        <th>Fecha del pago</th>
                        <td>{{$factura->payment->updated_at}}</td>
                    </tr>
                    @else
                        <tr>
                            <th>Fecha del pago</th>
                            <td>{{$factura->payment->created_at}}</td>
                        </tr>
                    @endif
                    @if($factura->status == 'Aprovado en tienda')
                    <tr>
                        <th>Pago total recibido</th>
                        <td>$.{{number_format($factura->payment->totalStore)}}</td>
                    </tr>
                        @endif
                </table>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-10">
                <div class="card-body">
                    <div class="card-header ">Detalle de la compra</div>
                    <table class="table table-sm">
                        <thead>
                        @foreach($factura->details as $detail)
                            <tr class="table-success">
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

