@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container">
            <div class="panel-title">
                <h2>Nombre del producto: {{ $product->name }}
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
                                    <td>{{ $product->description }}</td>
                                </tr>
                                <tr>
                                    <th>Precio</th
                                    <td>{{ $product->price }}</td>
                                </tr>
                                <tr>
                                    <th>Stock</th>
                                    <td>{{ $product->stock }}</td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td>{{$product->colors->implode('name',', ')}}</td>
                                </tr>
                                <tr>
                                    <th>Categoria</th>
                                    <td>{{$product->categories->implode('name',', ')}}</td>
                                </tr>
                                <tr>
                                    <th>Talla</th>
                                    <td>{{$product->sizes->implode('name',', ')}}</strong></td>
                                </tr>
                                <tr>
                                    <th>Actualizado</th>
                                    <td>{{ $product->updated_at }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Creado</th>
                                    <td>{{ $product->created_at }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        @foreach($product->imagenes as $img)
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
