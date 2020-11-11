<head>
    <meta charset="UTF-8">
    <title>Reporte Diario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>

<div class="container">
    <h2>Reporte diario</h2>
    <h6><div>{{$now->format("F j, Y, g:i a")}}</div></h6>

    <br><br>
    <h5 class="card-title">Consumo</h5>
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

    <br><br>
    <h5 class="card-title">Registros</h5>
    <table class="table table-sm">
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

    <br><br>

    <h5>Productos mas vendidos</h5>
    <div class="row">
        <div class="col-sm-8">
            <table class="table table-sm">
                <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">nombre</th>
                    <th scope="col">cantidad de compras</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sales as $product)
                    <tr class="table-primary">
                        <th scope="row">{{$product->id ?? __('no existe')}}</th>
                        <td>{{$product->name ?? __('no existe')}}</td>
                        <td>{{$product->sales ?? __('no existe')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <br><br>

    <h5>Productos mas vistos</h5>
    <div class="row">
        <div class="col-sm-8">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad de visitas</th>
                </tr>
                </thead>
                <tbody>
                @foreach($visit as $product)
                    <tr>
                        <th scope="row">{{$product->id ?? __('no existe')}}</th>
                        <td>{{$product->name ?? __('no existe')}}</td>
                        <td>{{$product->visits ?? __('no existe')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <br><br>

    <h5>Productos mejor calificados</h5>
    <div class="row">
        <div class="col-sm-8">
            <table class="table table-sm table-bordered">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad de votos</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rating as $product)
                    <tr>
                        <th scope="row">{{$product->rateable->id ?? __('no existe')}}</th>
                        <td>{{$product->rateable->name ?? __('no existe')}}</td>
                        <td>{{$product->score ?? __('no existe')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <br><br>

    <h5>Productos mas vendidos</h5>
    <div class="row">
        <div class="col-sm-8">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($r as $product)
                    <tr>
                        <th scope="row">{{$product->product->id ?? __('no existe')}}</th>
                        <td>{{$product->product->name ?? __('no existe')}}</td>
                        <td>${{number_format($product->total) ?? __('no existe')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <br><br>

    <h5>Tallas mas vendidas.</h5>
    <div class="row">
        <div class="col-sm-8">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sizeSales as $size)
                    <tr>
                        <th scope="row">{{$size->size->id ?? __('no existe')}}</th>
                        <td>{{$size->size->name ?? __('no existe')}}</td>
                        <td>${{number_format($size->total) ?? __('no existe')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <br><br>

    <h5>Categorias mas vendidas</h5>
    <div class="row">
        <div class="col-sm-8">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categorySales as $category)
                    <tr>
                        <th scope="row">{{$category->category->id ?? __('no existe')}}</th>
                        <td>{{$category->category->name ?? __('no existe')}}</td>
                        <td>${{number_format($category->total) ?? __('no existe')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    <br><br>

    <h5>Colores mas venditos</h5>
        <div class="col-sm-8">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($colorSales as $color)
                    <tr>
                        <th scope="row">{{$color->color->id ?? __('no existe')}}</th>
                        <td>{{$color->color->name ?? __('no existe')}}</td>
                        <td>${{number_format($color->total) ?? __('no existe')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
