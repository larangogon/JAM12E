@extends('layouts.app')
@section('content')
    @can('Administrator')
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
            <div class="col-sm-4">
                <div class="card border-warning">
                    <div class="card-body">
                        <h5 class="card-title">Reporte General</h5>
                        <p class="card-text">
                            Reporte con detalle de la tienda.
                        </p>
                        <a href="{{ route('reportGeneral') }}">
                            <button type="button" class="btn btn-block btn-warning btn-sm float-right">
                                Generar <i class="far fa-file-pdf"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-success">
                    <div class="card-body">
                        <h5 class="card-title">Reporte en excel</h5>
                        <p class="card-text">
                            Reporte diario en excel.
                        </p>
                        <a href="{{ route('reportGeneralExport') }}">
                            <button type="button" class="btn btn-block btn-success btn-sm float-right">
                                Generar <i class="far fa-file-pdf"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Reporte financiero</h5>
                        <p class="card-text">
                            Reporte de ordenes.
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
                    <td>Generado por Admin</td>
                    <td># admin</td>
                    <td>Datos del reporte</td>
                    <td>Fecha de creacion</td>
                    <td>Eliminar</td>
                </tr>
                </thead>
                <tbody>
                @foreach($reports as $report)
                    <tr>
                        <td>{{$report->id}}</td>
                        <td>{{$report->user->name}}</td>
                        <td>{{$report->user->id}}</td>
                        <td>{{$report->file}}</td>
                        <td>{{$report->created_at}}</td>
                        <td class="v-align-middle">
                            <form action= "{{ route('reports.destroy',  $report->id)}}" method = "POST">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"  role="button">
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
    @endcan
@endsection