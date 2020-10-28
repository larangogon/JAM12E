@extends('layouts.app')
@section('content')
    <div class="container">
        <p>
            {{$now->format("F j, Y, g:i a")}}
        </p>

        <div class="card-deck">
            <div class="card text-white bg-dark mb-2" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Consumo</h5>
                    <p class="card-text"> Hoy se ha agregado {{$hoy}} nuevas ordenes</p>
                    <p class="card-text">Hoy se ejecutaron {{$pay}} pagos.</p>
                </div>
            </div>
            <div class="card text-white bg-primary mb-2" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Consumo</h5>
                    <p class="card-text"> Hoy se ha agregado {{$hoy}} nuevas ordenes</p>
                    <p class="card-text">Hoy se ejecutaron {{$pay}} pagos.</p>
                </div>
            </div>
            <div class="card text-white bg-success mb-2" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Productos mas vendidos</h5>
                    <p class="card-text">
                        @foreach($sales as $product)
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <th scope="col">Id</th>
                                    <td>{{$product->id}}</td>
                                    <th scope="col">Name</th>
                                    <td>{{$product->name}}</td>
                                    <th scope="col"></th>
                                    <td>{{$product->sales}}</td>
                                </tr>
                            </tbody>
                        </table>
                        @endforeach
                    </p>
                </div>
            </div>
            <div class="card text-white bg-danger mb-2" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Productos mas visitados</h5>
                    <p class="card-text">
                    @foreach($visit as $product)
                        <table class="table table-sm">
                            <tbody>
                            <tr>
                                <th scope="col">Id</th>
                                <td>{{$product->id}}</td>
                                <th scope="col">Name</th>
                                <td>{{$product->name}}</td>
                                <th scope="col"></th>
                                <td>{{$product->visits}}</td>
                            </tr>
                            </tbody>
                        </table>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <order-metric inline-template>
                    <div class="card">
                        <div class="card-content">
                            <div class="chart-container">
                                <canvas id="orderBar" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </order-metric>
            </div>
            <div class="col-sm-4">
                <payment-metric inline-template>
                    <div>
                        <div class="card">
                            <div class="card-content">
                                <div class="chart-container">
                                    <canvas id="paymentBar" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </payment-metric>
            </div>
            <div class="col-sm-4">
                <payment-metric inline-template>
                    <div>
                        <div class="card">
                            <div class="card-content">
                                <div class="chart-container">
                                    <canvas id="paymentLine" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </payment-metric>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title">Reporte Anual</h5>
                    <p class="card-text">
                        Reporte anual con detalle de productos, ordenes y pagos.
                    </p>
                    <a href="{{ route('reportAnual') }}">
                        <button type="button" class="btn btn-warning btn-sm float-right">
                            Generar Reporte
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
