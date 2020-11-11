@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2>
                        Producto Creados
                    </h2>
                </div>
                <div class="col-md-4">
                    <nav class="mt-2 float-right">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <p>Opciones Avanzadas</p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('exportUsers') }}">
                                            <button type="button" class="btn btn-primary btn-sm btn-block float-right">
                                                Exportar Usuarios
                                            </button>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('imports.index') }}">
                                            <button type="button" class="btn btn-dark btn-block btn-sm float-right">
                                                Importar Usuarios
                                            </button>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="users/create">
                                            <button type="button" class="btn btn-success btn-sm btn-block float-right">
                                                Agregar Usuario
                                            </button>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
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
                    <th scope="col">Nombre</th>
                    <th scope="col">document</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->document}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->roles->implode('name',', ')}}</td>
                        <td>
                            <form action= "{{ route('users.active',  $user->id)}}" method = "POST">
                                <a href="{{route('users.show', $user->id) }}">
                                    <button type="button" class="btn btn-dark btn-sm">
                                        Ver
                                    </button>
                                </a>
                                <a href="{{ route('users.edit', $user->id) }}">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        Editar
                                    </button>
                                </a>
                                @csrf
                                @method('GET')
                                <button type="submit" class=" btn-sm btn {{$user->active ?  'btn-success' : 'btn-danger'}}" role="button" >{{$user->active ?  'activo' : 'inactivo'}}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="mx-auto">
                    {{ $users->links()}}
                </div>
            </div>
        </div>
    @endcan
@endsection
