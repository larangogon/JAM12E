@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="card border-success">
                    <div class="card-body">
                        <h5 class="card-title">Reporte de ordenes</h5>
                        <p class="card-text">Reporte mensual con detalle de las ordenes creadas.</p>
                        <a href="{{ route('reportOrders') }}">
                            <button type="button" class="btn btn-success btn-sm float-right">
                                Generar Reporte
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Reporte de productos</h5>
                        <p class="card-text">Reporte semestral con detalle de los productos creados</p>
                        <a href="{{ route('reportProducts') }}">
                            <button type="button" class="btn btn-primary btn-sm float-right">
                                Generar Reporte
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-warning">
                    <div class="card-body">
                        <h5 class="card-title">Reporte Anual</h5>
                        <p class="card-text">
                            Reporte anual con detalle de productos, ordenes y pagos.</p>
                        <a href="{{ route('reportAnual') }}">
                            <button type="button" class="btn btn-warning btn-sm float-right">
                                Generar Reporte
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="card border-danger">
                    <div class="card-body">
                        <h5 class="card-title">Reporte de usuarios</h5>
                        <p class="card-text">Reporte semestral con detalle de los usuarios registrados</p>
                        <a href="{{ route('reportUsers') }}">
                            <button type="button" class="btn btn-danger btn-sm float-right">
                                Generar Reporte
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-info">
                    <div class="card-body">
                        <h5 class="card-title">Reporte pagos</h5>
                        <p class="card-text"> Reporte mensual con detalle de los pagos generados.</p>
                        <a href="{{ route('reportPayments') }}">
                            <button type="button" class="btn btn-info btn-sm float-right">
                                Generar Reporte
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Reporte de envios</h5>
                        <p class="card-text">Reporte mensual con detalle del estado de los esvios.</p>
                        <a href="{{ route('reportShippings') }}">
                            <button type="button" class="btn btn-dark btn-sm float-right">
                                Generar Reporte
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
