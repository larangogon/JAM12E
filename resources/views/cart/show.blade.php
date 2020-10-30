@extends('layouts.app')

@section('content')

@if(count($cart->products))

    <div>
        @if (session('success'))
            <div class="alert-default-success" role="alert">
                <p>{{session('success')}}</p>
            </div>
        @endif
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="container" style="margin-top: 5px">
    <div class="row justify-content-center align-items-center">
        <div class="col-sm-9">
            <h2><div class="row justify-content-center align-items-center">
                    Carrito de compras
                </div>
            </h2>
            <p>
                <a href="{{ route('cart.remove')}}" class="btn btn-danger btn-sm">
                    Vaciar carrito
                </a>
                <a href="{{route('vitrina.index') }}" class="btn btn-primary btn-sm">
                    Seguir comprando
                </a>
            </p>
            <table class="table">
                <thead>
                    <tr class="thead-dark">
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>talla</th>
                        <th>color</th>
                        <th>Precio unitario</th>
                        <th>Cantidad</th>
                        <th>Precio total</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart->products as $product )
                    <tr>
                        <td>
                            <img  class="img img:hover"
                                  src= "../uploads/{{$product->imagenes()->first()['name']}}"
                                  width="50" height="50"
                            />
                        </td>
                        <th class="v-align-middle">
                            {{$product->name }}
                        </th>
                        <th class="v-align-middle">
                            {{$product->pivot->size->name}}
                        </th>
                        <th class="v-align-middle">
                            {{$product->pivot->color->name}}
                        </th>
                        <th class="v-align-middle">
                            ${{number_format($product->price) }}
                        </th>
                        <th class="v-align-middle">
                            <form action = "{{ route('cart.update', $product->pivot->id)}}" method="POST">
                                <input type="hidden"  name="id" value="{{ $product->pivot->id }}">
                                <input type="number" placeholder="{{$product->pivot->stock }}
                                "name="stock" min="1" max="100">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning btn-sm" role="button">
                                    <i class="fas fa-undo-alt"></i>
                                </button>
                            </form>
                            @error('stock')
                             {{$message}}
                            @enderror
                        </th>
                        <th class="v-align-middle">
                            ${{number_format($product->price * $product->pivot->stock)}}
                        </th>
                        <th class="v-align-middle">
                            <form action= "{{ route('cart.destroy', $product->pivot->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $product->pivot->id }}">
                                <button type="submit" class="btn btn-danger btn-sm" role="button">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <table align="right">
                <th>
                    <div class="badge badge-light text-wrap">
                        <h5>
                            Total con IVA ${{$cart->valorCarrito()}}
                        </h5>
                        <a href="{{route('orders.create', $product->id) }}">
                          <button type="button" class="btn btn-success btn-block text-left">
                              Continuar con la compra
                          </button>
                        </a>
                    </div>
                </th>
            </table>
        </div>
        @else
            <div class="card">
                <div class="card-body">
                    <h3>
                        <div class="row justify-content-center align-items-center">
                             Sorry, There are no products in the cart
                        </div>
                    </h3>
                    <div class="row justify-content-center align-items-center">
                        <a href="{{route('vitrina.index') }}" class="btn btn-outline-primary">
                            Seguir comprando
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection


