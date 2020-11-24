<head>
    <meta charset="UTF-8">
    <title>Reporte Diario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<table>
    <thead>
    <tr>
        <th align="right"><b>Fecha</b></th>
        <th align="right"><b>ordenes generadas</b></th>
        <th align="right"><b>Pagos cancelados</b></th>
        <th align="right"><b>Pagos approvados</b></th>
        <th align="right"><b>Pagos rechazados</b></th>
        <th align="right"><b>Pagos pendientes</b></th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <th align="right">{{$fecha}}</th>
            <th align="right">{{$hoy ?? __('no existe')}}</th>
            <th align="right">{{$cancel ?? __('no existe')}}</th>
            <th align="right">{{$pay ?? __('no existe')}}</th>
            <th align="right">{{$rechazadas ?? __('no existe')}}</th>
            <th align="right">{{$pending ?? __('no existe')}}</th>
        </tr>
    </tbody>
</table>
<br>
<table>
    <thead>
    <tr>
        <th align="right"><b>id</b></th>
        <th align="right"><b>status</b></th>
        <th align="right"><b>Total</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($orderlist as $order)
        <tr>
            <th align="right">{{$order->id ?? __('Tienda')}}</th>
            <th align="right">{{$order->status ?? __('Gasto de tienda')}}</th>
            <th align="right">${{number_format($gasto->total) ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<br>
