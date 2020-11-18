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
        <th>Pagos cancelados</th>
        <td>{{$cancelled}}</td>
    </tr>
    <tr>
        <th>Ordenes generadas hoy</th>
        <td>{{$hoy}}</td>
    </tr>
    <tr>
        <th>Pagos generados hoy</th>
        <td>{{$pay ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th>Pagos actualizados hoy</th>
        <td>{{$payments ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th>Valor de la factura mas alto</th>
        <td>$.{{$price ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th>Ordenes aprovadas</th>
        <td>{{$approved ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th>Ordenes rechazadas</th>
        <td>{{$rejected ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th>Total de todas las ordenes</th>
        <td>$.{{$order->sum('total') ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th>Total facturas aprovadas</th>
        <td>$.{{$sum ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th>Total facturas rechazadas</th>
        <td>$.{{$sumRechazada ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th>Total facturas pendientes</th>
        <td>$.{{$sumPending ?? __('no existe')}}</td>
    </tr>
</table>
<br>
<h5>Registros</h5>
<table>
    <tr>
        <th>Usuarios registrados</th>
        <td>{{$users ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th>Total votos</th>
        <td>{{$ratinAllProducs ?? __('no existe')}}</td>
    </tr>
    <tr>
        <th>Productos creados</th>
        <td>{{$products ?? __('no existe')}}</td>
    </tr>
</table>
<br>
<h5>Productos mas vendidos</h5>
<table>
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Cantidad de compras</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sales as $product)
        <tr class="table-primary">
            <td>{{$product->id ?? __('no existe')}}</td>
            <td>{{$product->name ?? __('no existe')}}</td>
            <td>{{$product->sales ?? __('no existe')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Productos mas vistos</h5>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Cantidad de visitas</th>
    </tr>
    </thead>
    <tbody>
    @foreach($visit as $product)
        <tr>
            <th>{{$product->id ?? __('no existe')}}</th>
            <th>{{$product->name ?? __('no existe')}}</th>
            <th>{{$product->visits ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Productos mejor calificados</h5>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Cantidad de votos</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rating as $product)
        <tr>
            <th>{{$product->rateable->id ?? __('no existe')}}</th>
            <th>{{$product->rateable->name ?? __('no existe')}}</th>
            <th>{{$product->score ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Operaciones con mas gasto</h5>
<table>
    <thead>
    <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($gastos as $gasto)
        <tr>
            <th>{{$gasto->product->barcode ?? __('Tienda')}}</th>
            <th>{{$gasto->product->name ?? __('Gasto de tienda')}}</th>
            <th>${{number_format($gasto->total) ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<table>
    <tr>
        <th>Gato con valor mas alto</th>
        <td>$.{{$gastoMax}}</td>
    </tr>
    <tr>
        <th>Descripcion de este gasto</th>
        <td>{{$gastoDescrip}}</td>
    </tr>
</table>
<br>
<h5>Productos mas vendidos</h5>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($r as $product)
        <tr>
            <th>{{$product->product->id ?? __('no existe')}}</th>
            <th>{{$product->product->name ?? __('no existe')}}</th>
            <th>${{number_format($product->total) ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Tallas mas vendidas.</h5>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sizeSales as $size)
        <tr>
            <th>{{$size->size->id ?? __('no existe')}}</th>
            <th>{{$size->size->name ?? __('no existe')}}</th>
            <th>${{number_format($size->total) ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Categorias mas vendidas</h5>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($categorySales as $category)
        <tr>
            <th>{{$category->category->id ?? __('no existe')}}</th>
            <th>{{$category->category->name ?? __('no existe')}}</th>
            <th>${{number_format($category->total) ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<h5>Colores mas vendidos</h5>
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($colorSales as $color)
        <tr>
            <th>{{$color->color->id ?? __('no existe')}}</th>
            <th>{{$color->color->name ?? __('no existe')}}</th>
            <th>${{number_format($color->total) ?? __('no existe')}}</th>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
