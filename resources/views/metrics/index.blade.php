@extends('layouts.app')
@section('content')
    <div class="container">

        <section class="hero">
            <div class="hero-body">
                <div class="container">
                    <h1 class="title">
                        Metricas
                    </h1>
                </div>
            </div>
        </section>
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
