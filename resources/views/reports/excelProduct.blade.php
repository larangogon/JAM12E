<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
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
