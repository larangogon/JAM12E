<!DOCTYPE html>
<html lang="es">
<head>
    <style>
        html {
            margin: 0;
        }

        @page {
            margin: 0cm 0cm;
            font-family: Arial;
        }

        body {
            font-family: "Times New Roman", serif;
            margin: 45mm 8mm 2mm 8mm;
        }

       main{
            margin: 2cm 2cm 2cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
            background-color: lightskyblue;
            color: black;
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
                <div></div>
            </div>
        </h6>
    </div>
</header>
<main>
    <div class="container">
        <h2>Reporte de ordenes</h2>
        <br>
        <h6><dv>{{$now->format("F j, Y, g:i a")}}</dv></h6>

        <h5 class="card-title">Consumo</h5>
        <p>El total de todas las ordenes es $.{{number_format($order->sum('total')) ?? __('no existe')}}. Hasta
            {{$now->format("F j, Y, g:i a")}}
        </p>
        <table class="table  table-sm table-hover table-bordered">
            <thead>
            <tr class="table-primary">
                <th scope="col">#</th>
                <th scope="col">Usuario</th>
                <th scope="col">Estado</th>
                <th scope="col">Total</th>
                <th scope="col">Actualizado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order as $orde)
                <tr>
                    <td>{{$orde->id ?? __('no existe')}}</td>
                    <td>{{$orde->user->name ?? __('no existe')}}</td>
                    <td>{{$orde->status ?? __('no existe')}}</td>
                    <td>$.{{number_format($orde->total ?? __('no existe'))}}</td>
                    <td>{{$orde->updated_at->format("F j, Y") ?? __('no existe')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</main>

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
