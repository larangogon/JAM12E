@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card border-success">
                <div class="card-body">
                    <h5 class="card-title">Reporte de ordenes</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="{{ route('reportOrders') }}">
                        <button type="button" class="btn btn-primary btn-sm float-right">
                            Generar Reporte
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="card-title">Reporte de productos</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="{{ route('reportProducts') }}">
                        <button type="button" class="btn btn-primary btn-sm float-right">
                            Generar Reporte
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card border-danger">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="">
                        <button type="button" class="btn btn-primary btn-sm float-right">
                            xxx
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="">
                        <button type="button" class="btn btn-primary btn-sm float-right">
                            xxxx
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
