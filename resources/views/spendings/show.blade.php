@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="container">
                            <div class="panel-title">
                                <h2>
                                    <a href="{{ route('spendings.index') }}" class="btn btn-outline-success  btn-sm">
                                        Volver
                                    </a>
                                </h2>
                            </div>
                            <table class="table table-sm">
                                <tr>
                                    <th>Descripcion</th>
                                    <td>{{ $spending->description }}</td>
                                </tr>
                                <tr>
                                    <th>Codigo del producto</th>
                                    <td>{{ $spending->product->barcode ?? ('No es un gasto de insumos') }}</td>
                                </tr>
                                <tr>
                                    <th>Id del producto</th>
                                    <td>{{ $spending->product->id ?? ('No es un gasto de insumos') }}</td>
                                </tr>
                                <tr>
                                    <th>Nombre del producto</th>
                                    <td>{{ $spending->product->name ?? ('No es un gasto de insumos') }}</td>
                                </tr>
                                <tr>
                                    <th>Gasto</th>
                                    <td>$.{{ number_format($spending->total) }}</td>
                                </tr>
                                <tr>
                                    <th>Creado por</th>
                                    <td>{{$spending->userCreate->name}}</td>
                                </tr>
                                <tr>
                                    <th>Editado por</th>
                                    <td>{{$spending->userUpdate->name ?? ('No editado')}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endcan
@endsection
