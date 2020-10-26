@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card-deck">
            <div class="card text-white bg-primary mb-2" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Consumo</h5>
                    <p class="card-text"> Hoy se ha agregado {{$hoy}} nuevas ordenes</p>
                </div>
            </div>
            <div class="card text-white bg-success mb-2" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Success card title</h5>
                    <p class="card-text">Hoy se ejecutaron {{$pay}} pagos.</p>
                </div>
            </div>
            <div class="card text-white bg-danger mb-2" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Danger card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <section class="hero">
            <div class="hero-body">
                <div class="container">
                    <h3>
                        Orders
                    </h3>
                </div>
            </div>
        </section>
        <order-metric inline-template>
            <div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="columns">
                            <div class="column">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="chart-container">
                                            <canvas id="orderBar" height="150"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="chart-container">
                                            <canvas id="orderPie" height="150"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="columns">
                            <div class="column">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="chart-container">
                                            <canvas id="orderLine" height="150"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </order-metric>
        <div class="container">
            <h3>
                Pagos
            </h3>
        </div>
        <payment-metric inline-template>
            <div>
                <div class="col-sm-6">
                    <div class="columns">
                        <div class="column">
                            <div class="card">
                                <div class="card-content">
                                    <div class="chart-container">
                                        <canvas id="paymentBar" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </payment-metric>
    </div>
@endsection
