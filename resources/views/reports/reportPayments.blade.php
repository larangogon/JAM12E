<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<div class="container">
    <h2>Reporte de pagos mensual</h2>
    <div class="justify-content-center">
        <h6>
            <div class="clearfix">
                <div>Empresa</div>
                <div>xxxx</div>
                <div>NIT 98764553, <br> Codigo 123000000083736</div>
                <div>xxxx@gmail.com</div>
            </div>
        </h6>
    </div>
    <p>
        El próximo domingo, los ciudadanos tendrán ocasión de hacer política,
        de participar en la toma de decisiones públicas, cuando depositen su voto para elegir
        a 194 diputados de mayoría y tal vez cincuenta de partido. La democracia electoral les
        permite, de ese modo ejercer  funciones de gobierno.
    </p>
    <div class="card">
        <table class="table table-hover table-bordered">
            <thead>
            <tr class="table-primary">
                <th scope="col">
                    ID
                </th>
                <th scope="col">
                    status
                </th>
                <th scope="col">
                    amount
                </th>
                <th scope="col">
                    order id
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($payment as $payment)
                <tr>
                    <td>
                        {{$payment->id}}
                    </td>
                    <td>
                        {{$payment->status}}
                    </td>
                    <td>
                        {{number_format($payment->amount)}}
                    </td>
                    <td>
                        {{$payment->order_id}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
