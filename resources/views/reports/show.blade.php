<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Factura de compra</title>
</head>
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
</html>

