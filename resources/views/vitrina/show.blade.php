@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert-default-success" role="alert">
        <p>{{session('success')}}</p>
    </div>
@endif

@if ($errors->any())
    <div class="alert-default-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <div class="content-box-large">
        <div class="panel-heading">
            <div class="panel-title">
                <h2>Nombre del producto: {{ $products->name }}
                    <a href="{{ route('vitrina.index') }}" class="btn btn-success btn-sm btn:hover">Volver</a>
               </h2></div>
            </div>
              <div class="row">
                  <div class="col-md-4">
                      <div class="card">
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
                      </table>
                      </div>
                  </div>

                  <div class="col-md-3">
                      <div class="card-body">
                        <!-- Mostramos todas las imágenes pertenecientes a a este registro -->
                        @foreach($products->imagenes as $img)
                            <a data-fancybox="gallery" href="../../../uploads/{{ $img->name }}">
                                <img class="img img:hover" src="../../../uploads/{{ $img->name }}" width="200"  class="img-fluid">
                            </a>
                        @endforeach
                      </div>
                  </div>
                  <div class="col-md-5">
                      <div class="card-body">
                        <form action="{{route('cart/add') }}" method="POST">
                        @csrf

                        <h2>Datos para tu compra</h2>
                            <table class="table">
                                <tr>
                                    <th>Elige una cantidad</th>
                                    <td>
                                        <input type="number" placeholder="0" name="stock" min="1" max="100">
                                        @error('stock')
                                        {{$message}}
                                        @enderror
                                        <input type="hidden" value="{{$products->id}}" name="products_id">
                                    </td>
                                </tr>

                                <tr>
                                    <th>Selecciona un color</th>
                                    <td>
                                        <select name="color_id" class="form-control">
                                            <option selected disabled>elige un color</option>
                                            @foreach ($products->colors as $color )
                                                <option value="{{ $color->id}}">{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                        </select>
                                        @error('color_id')
                                        {{$message}}
                                        @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <th>Selecciona una talla</th>
                                    <td>
                                        <select name="size_id" class="form-control">
                                            <option selected disabled>elige una talla</option>
                                            @foreach ($products->sizes as $size )
                                                <option value="{{ $size->id}}">{{$size->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('size_id')
                                        {{$message}}
                                        @enderror
                                    </td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-block btn-sm btn-primary">
                                Agregar al Carrito
                            </button>
                    </form>
                  </div>
              </div>
          </div>
    </div>
</div>


@endsection
