@extends('layouts.app')

@section('content')

<p>
    <button class="btn btn-primary" type="button" data-toggle="collapse"
            data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">
        Reporte de ventas
    </button>
    <button class="btn btn-primary" type="button" data-toggle="collapse"
            data-target="#multiCollapseExample3" aria-expanded="false" aria-controls="multiCollapseExample2">
        Reporte de productos
    </button>
</p>
<div class="row">
    <div class="col">
        <div class="collapse multi-collapse" id="multiCollapseExample2">
            <div class="card card-body">
                AQUI VA IMAGEN O VISTA PREVIA DEL REPORTE EJEMPO
                <a href="{{ route('reportOrders') }}">
                    <button type="button" class="btn btn-primary btn-sm float-right">
                        Generar archivo PDF
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="collapse multi-collapse" id="multiCollapseExample3">
            <div class="card card-body">
                AQUI VA IMAGEN O VISTA PREVIA DEL REPORTE EJEMPO
                <a href="{{ route('reportProducts') }}">
                    <button type="button" class="btn btn-primary btn-sm float-right">
                        Generar archivo PDF
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
