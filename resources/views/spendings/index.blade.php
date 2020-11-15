@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container">
            @if (session('success'))
                <div class="alert-default-success" role="alert">
                    <p>{{session('success')}}</p>
                </div>
            @endif
            <h3>
                Gastos
                <a href="spendings/create">
                    <button type="button" class="btn btn-success btn-sm float-right">
                        Agregar
                    </button>
                </a>
            </h3>
            <h6>
                @if($search)
                    <div class="alert-default-primary" role="alert">
                        Los resultados para tu busqueda '{{$search}}' son:
                    </div>
                @endif
            </h6>
            <table class="table table-hover table-bordered table-sm">
                <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">Description</th>
                    <th scope="col">Creado por</th>
                    <th scope="col">Actualizado por</th>
                    <th scope="col">Total</th>
                    <th scope="col">Eliminar</th>
                    <th scope="col">Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($spendings as $spending)
                    <tr>
                        <th scope="row">{{$spending->id}}</th>
                        <td>{{$spending->description}}</td>
                        <td>{{$spending->userCreate->name}}</td>
                        <td>{{$spending->userUpdate->name ?? ('No editado')}}</td>
                        <td>$.{{number_format($spending->total)}}</td>
                        <td>
                            <form action= "{{ route('spendings.destroy',  $spending->id)}}" method = "POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"  role="button" onclick="return confirmarEliminar()">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{route('spendings.show', $spending->id) }}">
                                <button type="button" class="btn btn-dark btn-sm">
                                    Ver
                                </button>
                            </a>
                            <a href="{{ route('spendings.edit', $spending->id) }}">
                                <button type="button" class="btn btn-primary btn-sm">
                                    Editar
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="mx-auto">
                    {{ $spendings->links()}}
                </div>
            </div>
        </div>
        </div>
    @endcan
@endsection
