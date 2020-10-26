@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container">
            <div class="panel-title">
                <h2>Nombre del producto: {{ $products->name }}
                    <a href="{{ route('products.index') }}" class="btn btn-outline-success  btn-sm">
                        Volver
                    </a>
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="container">
                            <table class="table">
                                <tr>
                                    <th>Descripcion</th>
                                    <td>{{ $products->description }}</td>
                                </tr>
                                <tr>
                                    <th>Precio</th>
                                    <td>{{ $products->price }}</td>
                                </tr>
                                <tr>
                                    <th>Stock</th>
                                    <td>{{ $products->stock }}</td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td>{{$products->colors->implode('name',', ')}}</td>
                                </tr>
                                <tr>
                                    <th>Categoria</th>
                                    <td>{{$products->categories->implode('name',', ')}}</td>
                                </tr>
                                <tr>
                                    <th>Talla</th>
                                    <td>{{$products->sizes->implode('name',', ')}}</strong></td>
                                </tr>
                                <tr>
                                    <th>Actualizado</th>
                                    <td>{{ $products->updated_at }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Creado</th>
                                    <td>{{ $products->created_at }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        @foreach($products->imagenes as $img)
                            <a data-fancybox="gallery" href="../../../uploads/{{ $img->name }}">
                                <img class="img img:hover" src="../../../uploads/{{ $img->name }}" width="200" class="img-fluid">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
