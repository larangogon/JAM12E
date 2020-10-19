@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert-default-success" role="alert">
            <p>{{session('success')}}</p>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-black">
                    <p class="card-text">@include('orders.status')</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-primary">
                <table class="table">
                    <tr>
                        <th>Nombre</th>
                        <td>{{$order->user->name}}</td>
                    </tr>
                    <tr>
                        <th>Telefono</th>
                        <td>{{$order->user->phone}}</td>
                    </tr>
                    <tr>
                        <th>Celular</th>
                        <td>{{$order->user->cellphone}}</td>
                    </tr>
                    <tr>
                        <th>Correo</th>
                        <td>{{$order->user->email}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-primary">
                <table class="table">
                    <tr>
                        <th>Order Id</th>
                        <td>{{$order->id}}</td>
                    </tr>
                    <tr>
                        <th>Total de la orden</th>
                        <td>{{$order->total}}</td>
                    </tr>
                    <tr>
                        <th>Estatus de la orden </th>
                        <td>{{$order->status}}</td>
                    </tr>
                    <tr>
                        <th>Estado del pago</th>
                        <td>{{$order->payment->status}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-success">
                <div class="card-header ">Detalle de la compra</div>
                    <table class="table">
                        <thead>
                        @foreach($order->details as $detail)
                            <tr>
                                <th>Nombre</th>
                                <th>talla</th>
                                <th>color</th>
                                <th>Cantidad</th>
                                <th>subtotal</th>
                            </tr>
                        <thead>
                        <tr>
                            <th class="v-align-middle">
                                {{ $detail->product->name}}
                            </th>
                            <th class="v-align-middle">
                                {{ $detail->size->name}}
                            </th>
                            <th class="v-align-middle">
                                {{ $detail->color->name}}
                            </th>
                            <th class="v-align-middle">
                                {{ $detail->stock}}U
                            </th>
                            <th class="v-align-middle">
                                ${{ number_format($detail->total) }}
                            </th>
                        </tr>
                        @endforeach
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

