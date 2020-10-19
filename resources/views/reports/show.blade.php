<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Factura de compra</title>
    </head>
    <body>
        <header class="clearfix">
            <h1>RECIBO DE PAGO No# {{$factura->id}}</h1>
            <div class="clearfix">
                <div>Empresa</div>
                <div>xxxx</div>
                <div>NIT 98764553, <br> Codigo 123000000083736</div>
                <div>xxxx@gmail.com</div>
            </div>
            <h3>Datos del usuario</h3>
            <div class="col-md-4">
                <div class="justify-content-end" >
                    <div>A nombre de: {{$factura->user->name}}</div>
                    <div>Telefono: {{$factura->user->phone}}</div>
                    <div>Email: {{$factura->user->email}}</div>
                    <div>Documento: {{$factura->user->document}}</div>
                </div>
            </div>
            <h3>Datos del pago</h3>
            <div class="col-md-4">
                <div class="justify-content-end" >
                    <div>Fecha de pago: {{$factura->payment->updated_at}}</div>
                    <div>Concepto de: Total: {{number_format($factura->payment->amount)}}</div>
                </div>
            </div>
            <h3>Detalle de la compra</h3>
                <table class="table">
                    <thead>
                    @foreach($factura->details as $detail)
                        <tr>
                            <th>Nombre</th>
                            <th>talla</th>
                            <th>color</th>
                            <th>Cantidad</th>
                            <th>subtotal</th>
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
                            ${{ number_format($detail->total) }}
                        </th>
                    </tr>
                    @endforeach
                    </thead>
                </table>
        </header>
    </body>
</html>
