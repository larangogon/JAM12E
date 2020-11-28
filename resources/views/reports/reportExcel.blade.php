<head>
    <meta charset="UTF-8">
    <title>Reporte Diario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<h2>Reporte diario</h2>
<h6><div>{{$now->format("F j, Y, g:i a")}}</div></h6>
<br>
<h5>Consumo</h5>
<table class="table table-sm">
    <tr>
        <th><b>Pagos cancelados</b></th>
        <td align="right">{{$cancelled}}</td>
    </tr>
    <tr>
        <th><b>Ordenes generadas hoy</b></th>
        <td align="right">{{$hoy}}</td>
    </tr>
    <tr>
        <th><b>Pagos generados hoy</b></th>
        <td align="right">{{$pay ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th><b>Pagos actualizados hoy</b></th>
        <td align="right">{{$payments ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th><b>Valor de la factura mas alto</b></th>
        <td align="right">$.{{number_format($price) ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th><b>Ordenes aprovadas</b></th>
        <td align="right">{{$approved ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th><b>Ordenes rechazadas</b></th>
        <td align="right">{{$rejected ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th><b>Total de todas las ordenes</b></th>
        <td align="right">$.{{number_format($order->sum('total')) ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th><b>Total facturas aprovadas</b></th>
        <td align="right">$.{{number_format($sum) ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th><b>Total facturas rechazadas</b></th>
        <td align="right">$.{{number_format($sumRechazada) ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th><b>Total facturas pendientes</b></th>
        <td align="right">$.{{number_format($sumPending) ?? __('no existe')}}</td>
    </tr>
</table>
<br>
<h5>Registros</h5>
<table>
    <tr>
        <th><b>Usuarios registrados</b></th>
        <td align="right">{{$users ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th><b>Total votos</b></th>
        <td align="right">{{$ratinAllProducs ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th><b>Productos creados</b></th>
        <td align="right">{{$products ?? __('no existe')}}</td>
    </tr>
</table>
<br>
<h5>Productos mayor intencion de compra</h5>
<table>
    <thead>
    <tr>
        <th align="right"><b>#</b></th>
        <th align="right"><b>Nombre</b></th>
        <th align="right"><b>Cantidad de compras</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($sales as $product)
        <tr class="table-primary">
            <td align="right">{{$product->id ?? __('no existe')}}</td>
            <td align="right">{{$product->name ?? __('no existe')}}</td>
            <td align="right">{{$product->sales ?? __('no existe')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Productos mas vistos</h5>
<table>
    <thead>
    <tr>
        <th align="right"><b>#</b></th>
        <th align="right"><b>Nombre</b></th>
        <th align="right"><b>Cantidad de visitas</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($visit as $product)
        <tr>
            <th align="right">{{$product->id ?? __('no existe')}}</th>
            <th align="right">{{$product->name ?? __('no existe')}}</th>
            <th align="right">{{$product->visits ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Productos mejor calificados</h5>
<table>
    <thead>
    <tr>
        <th align="right"><b>#</b></th>
        <th align="right"><b>Nombre</b></th>
        <th align="right"><b>Score</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($rating as $product)
        <tr>
            <th align="right">{{$product->rateable->id ?? __('no existe')}}</th>
            <th align="right">{{$product->rateable->name ?? __('no existe')}}</th>
            <th align="right">{{$product->score ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Operaciones con mas gasto</h5>
<table>
    <thead>
    <tr>
        <th align="right"><b>Codigo</b></th>
        <th align="right"><b>Nombre</b></th>
        <th align="right"><b>Total</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($gastos as $gasto)
        <tr>
            <th align="right">{{$gasto->product->barcode ?? __('Tienda')}}</th>
            <th align="right">{{$gasto->product->name ?? __('Gasto de tienda')}}</th>
            <th align="right">${{number_format($gasto->total) ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<table>
    <tr>
        <th><b>Gato con valor mas alto</b></th>
        <td align="right">$.{{$gastoMax}}</td>
    </tr>
    <tr>
        <th><b>Descripcion de este gasto</b></th>
        <td align="right">{{$gastoDescrip}}</td>
    </tr>
</table>
<br>
<h5>Productos mas vendidos</h5>
<table>
    <thead>
    <tr>
        <th align="right"><b>#</b></th>
        <th align="right"><b>Nombre</b></th>
        <th align="right"><b>Total</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($productosMasVendidos as $product)
        <tr>
            <th align="right">{{$product->product->id ?? __('no existe')}}</th>
            <th align="right">{{$product->product->name ?? __('no existe')}}</th>
            <th align="right">${{number_format($product->total) ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Tallas mas vendidas.</h5>
<table>
    <thead>
    <tr>
        <th align="right"><b>#</b></th>
        <th align="right"><b>Nombre</b></th>
        <th align="right"><b>Total</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($sizeSales as $size)
        <tr>
            <th align="right">{{$size->size->id ?? __('no existe')}}</th>
            <th align="right">{{$size->size->name ?? __('no existe')}}</th>
            <th align="right">${{number_format($size->total) ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Categorias mas vendidas</h5>
<table>
    <thead>
    <tr>
        <th align="right"><b>#</b></th>
        <th align="right"><b>Nombre</b></th>
        <th align="right"><b>Total</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($categorySales as $category)
        <tr>
            <th align="right">{{$category->category->id ?? __('no existe')}}</th>
            <th align="right">{{$category->category->name ?? __('no existe')}}</th>
            <th align="right">${{number_format($category->total) ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Colores mas vendidos</h5>
<table>
    <thead>
    <tr>
        <th align="right"><b>#</b></th>
        <th align="right"><b>Nombre</b></th>
        <th align="right"><b>Total</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($colorSales as $color)
        <tr>
            <th align="right">{{$color->color->id ?? __('no existe')}}</th>
            <th align="right">{{$color->color->name ?? __('no existe')}}</th>
            <th align="right">${{number_format($color->total) ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Usuarios con valor de compra mas alto</h5>
<table>
    <thead>
    <tr>
        <th align="right"><b>#</b></th>
        <th align="right"><b>Nombre</b></th>
        <th align="right"><b>Total</b></th>
    </tr>
    </thead>
    <tbody>
    @foreach($userTotalComprasMasAltas as $user)
        <tr>
            <th align="right">{{$user->user->id ?? __('no existe')}}</th>
            <th align="right">{{$user->user->name ?? __('no existe')}}</th>
            <th align="right">${{number_format($user->total) ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<br>
<br>
