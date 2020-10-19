@extends('layouts.app')
@section('content')

    <section class="hero">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    MÉTRICAS
                </h1>
            </div>
        </div>
    </section>
    <order-metric inline-template>
        <div>
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="chart-container">
                                <canvas id="orderBar" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="chart-container">
                                <canvas id="orderPie" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="card">
                        <div class="card-content">
                            <div class="chart-container">
                                <canvas id="orderLine" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </order-metric>
@endsection
