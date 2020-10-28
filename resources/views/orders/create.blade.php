@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 5px">
    <div class="row justify-content-center align-items-center">
        <div class="col-sm-8">
            <h2>
                <div class="row justify-content-center align-items-center">
                    Dettalle de la compra
                </div>
            </h2>
                <table class="table">
                    <thead>
                        <tr>
                        <h5>
                            <div class="row justify-content-center align-items-center">Datos del usuario</div>
                        </h5>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Direccion</th>
                            <th>Celular</th>
                            <th>Telefono</th>
                        </tr>
                    <thead>
                        <tr>
                            <th class="v-align-middle">{{auth()->user()->name}}</th>
                            <th class="v-align-middle">{{auth()->user()->document}}</th>
                            <th class="v-align-middle">{{auth()->user()->address}}</th>
                            <th class="v-align-middle">{{auth()->user()->phone}}</th>
                            <th class="v-align-middle">{{auth()->user()->cellphone}}</th>
                        </tr>
                    </thead>
                </table>

                <table class="table">
                    <thead>
                        <tr>
                            <h5>
                                <div class="row justify-content-center align-items-center">
                                    @auth {{auth()->user()->cart->productsCount()}}
                                    @endauth Producto(s) con un total de ${{$cart->valorCarrito()}}
                                </div>
                            </h5>
                        </tr>
                    <thead>
                        @foreach ($cart->products as $product)
                        <tr>
                            <td>
                                <img src= "../uploads/{{$product->imagenes()->first()['name']}}"
                                     width="50" height="50"
                                />
                            </td>
                            <th class="v-align-middle">{{$product->name }}</th>
                            <th class="v-align-middle">{{$product->pivot->size->name}}</th>
                            <th class="v-align-middle">{{$product->pivot->color->name}}</th>
                            <th class="v-align-middle">$.{{number_format($product->price) }}</th>
                            <th class="v-align-middle">{{$product->pivot->stock }}</th>
                            <th class="v-align-middle">$.{{number_format($product->price * $product->pivot->stock)}}</th>
                        </tr>
                        @endforeach
                    </thead>
                </table>

                <table align="right">
                    <th>
                        <div class="badge badge-light text-wrap" style="width: 10rem;">
                            <form action="{{route('orders.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{$cart->id}}">
                                <button type="submit" class="btn btn-success btn-block text-left">
                                    Generar Pago
                                </button>
                            </form>
                        </div>
                    </th>
                </table>
            </div>
      </div>
</div>

@endsection
