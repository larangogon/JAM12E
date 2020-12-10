@extends('layouts.app')
@section('content')
    <div class="container">
        <h6>
            @if($search)
                <div class="alert-default-primary" role="alert">
                    Los resultados para tu busqueda '{{$search}}' son:
                </div>
            @endif
        </h6>
        <div>
            @if (session('success'))
                <div class="alert-default-success" role="alert">
                    <p>{{session('success')}}</p>
                </div>
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-3">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Resumen General</h5>
                        <p class="card-text">
                            Resumen con detalle
                            <br>
                            - Datos de ordenes, pagos y productos
                            <br>
                            - Detalle de consumo
                            <br>
                            - Estadistica de ordenes y pagos
                        </p>
                        <a href="{{ route('reportGeneral') }}">
                            <button type="button" class="btn btn-block btn-dark btn-sm">
                                Generar <i class="far fa-file-pdf"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Reporte en excel</h5>
                        <p class="card-text">
                            Reporte diario en excel.
                            <br>
                            - Datos de ordenes, pagos, usuarios y productos
                            <br>
                            - Reporte para analisis administrativo
                        </p>
                        <a href="{{ route('reportGeneralExport') }}">
                            <button type="button" class="btn btn-block btn-dark btn-sm float-right">
                                Generar <i class="far fa-file-pdf"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Reporte en excel de productos</h5>
                        <p class="card-text">

                            - Top de colores mas vendidos
                            <br>
                            - Top de productos mas vendidos
                            <br>
                            - Top de tallas mas vendidas
                        </p>
                        <a href="{{ route('reportProductExport') }}">
                            <button type="button" class="btn btn-block btn-dark btn-sm float-right">
                                Generar <i class="far fa-file-pdf"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Reporte financiero</h5>
                        <p class="card-text">
                            - Filtro de ordenes por fecha
                            <br>
                            - Filtro de ordenes por estado
                            <br>
                            - Informe de todas las ordenes con valor total de consumo y detalle de la misma
                        </p>
                        @include('reports.modal')
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <table class="table table-bordered table-sm">
                <thead>
                <tr class="bg-success">
                    <td scope="col">#</td>
                    <td>Reporte</td>
                    <td>Generado por Admin</td>
                    <td># admin</td>
                    <td>Datos del reporte</td>
                    <td>X</td>
                    <td>Fecha de creacion</td>
                    <td>X</td>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{$report->id}}</td>
                        <td>{{$report->name}}</td>
                        <td>{{$report->user->name}}</td>
                        <td>{{$report->user->id}}</td>
                        <td>{{$report->file}}</td>
                        <td>
                            @if($report->type == 'Excel')

                                <form action="{{route('ruteExcel') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$report->file}}" name="file">
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-cloud-download-alt"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{route('rute') }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$report->file}}" name="file">
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-cloud-download-alt"></i>
                                    </button>
                                </form>

                            @endif
                        </td>
                        <td>{{$report->created_at}}</td>
                        <td class="v-align-middle">
                            <form action= "{{ route('reports.destroy',  $report->id)}}" method = "POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"  role="button">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="mx-auto">
                {{ $reports->links()}}
            </div>
        </div>
    </div>
@endsection
