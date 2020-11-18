@extends('layouts.app')

@section('content')
<div class="container " style="margin-top: 5px">
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-8">
                <h2>
                    <div class="row justify-content-center align-items-center">
                        Dettalle de la compra
                    </div>
                </h2>
                    <table class="table table-sm">
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

                    <table class="table table-sm">
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
                            <tr class="table-success">
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
                            <div class="badge badge-light text-wrap" style="width: 12rem;">
                                <form action="{{route('orders.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="cart_id" value="{{$cart->id}}">
                                    <button type="submit" class="btn btn-dark btn-block border text-left"> Pagar con PlaceToPay</button>
                                </form>
                            </div>
                        </th>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@can('Administrator')
    <div class="container">
        <div class="card">
            <h5 class="card-header">Generar pago en tienda</h5>
            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                    Pago autorizado por tienda con usuario presete!
                </div>
                <form action="{{route('orders.paymentInStore')}}" method="post">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{$cart->id}}">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name">
                                    Nombre
                                </label>
                                <input type="text" class="form-control" name="name" placeholder="nombre pagador">
                            </div>
                            <div class="form-group">
                                <label for="document">
                                    Documento
                                </label>
                                <input type="text" class="form-control" name="document" placeholder="documento pagador">
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="text" class="form-control" name="email" placeholder="email pagador">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="mobile">
                                    Mobil
                                </label>
                                <input type="text" class="form-control" name="mobile" placeholder="mobil pagador">
                            </div>
                            <div class="form-group">
                                <label for="totalStore">
                                    Total
                                </label>
                                <input type="text" class="form-control" name="totalStore" placeholder="totalStore pagador">
                            </div>
                            <button type="submit" class="btn btn-dark">
                                Generar pago en la tienda
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endcan
@endsection
