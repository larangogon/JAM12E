@extends('layouts.app')
@section('content')
    <div class="container">
        <div>
            @if (session('success'))
                <div class="alert-default-success" role="alert">
                    <p>{{session('success')}}</p>
                </div>
            @endif
        </div>
        <p>
            {{$now->format("F j, Y, g:i a")}}
        </p>

        <div class="card-deck">
            <div class="card text-white bg-dark mb-2" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Consumo</h5>
                    <table class="table table-sm">
                        <tr>
                            <th>Cantidad de usuarios registrados hasta la fecha</th>
                            <td>{{$users}}</td>
                        </tr>
                        <tr>
                            <th>Cantidad de productos creados hasta la fecha</th>
                            <td>{{$products}}</td>
                        </tr>
                        <tr>
                            <th>Cantidad de pagos cancelados hasta la fecha</th>
                            <td>{{$cancelled}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card text-white bg-primary mb-2" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Consumo</h5>
                    <table class="table table-sm">
                        <tr>
                            <th>Cantidad de ordenes generadas hoy</th>
                            <td>{{$hoy}}</td>
                        </tr>
                        <tr>
                            <th>Cantidad de pagos ejecutados hoy</th>
                            <td>{{$pay}}</td>
                        </tr>
                        <tr>
                            <th>Cantidad de pagos actualizados hasta la fecha</th>
                            <td>{{$payments}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card text-white bg-gradient-success mb-2" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Productos mas vendidos</h5>
                    <p class="card-text">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">nombre</th>
                            <th scope="col"># ventas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sales as $product)
                            <tr>
                                <th scope="row">{{$product->id}}</th>
                                <td>{{$product->name}}</td>
                                <td>{{$product->sales}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card text-white bg-danger mb-2" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Productos mas vistos</h5>
                    <p class="card-text">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">nombre</th>
                            <th scope="col"># visitas</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($visit as $product)
                            <tr>
                                <th scope="row">{{$product->id}}</th>
                                <td>{{$product->name}}</td>
                                <td>{{$product->visits}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <order-metric inline-template>
                    <div class="card">
                        <h5 class="card-header">Estado de ordenes</h5>
                        <div class="card-content">
                            <div class="chart-container">
                                <canvas id="orderBar" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </order-metric>
            </div>
            <div class="col-sm-4">
                <cancelled-metric inline-template>
                    <div>
                        <div class="card">
                            <h5 class="card-header">Pagos cancelados</h5>
                            <div class="card-content">
                                <div class="chart-container">
                                    <canvas id="cancelledBar" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </cancelled-metric>
            </div>
            <div class="col-sm-4">
                <payment-metric inline-template>
                    <div>
                        <div class="card">
                            <h5 class="card-header">Estado de pagos</h5>
                            <div class="card-content">
                                <div class="chart-container">
                                    <canvas id="paymentBar" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </payment-metric>
            </div>
        </div>
        </div>
    </div>
@endsection

