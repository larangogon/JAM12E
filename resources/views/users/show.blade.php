@extends('layouts.app')

@section('content')
@can('Administrator')
    <div class="col-md-6">
          <div class="container">
            <h1 class="display-4">{{ $user->name}} <a href="{{ route('users.index') }}" class="btn btn-dark btn-sm">Volver</a></h1>
              <div class="card" >
                  <table class="table">
                      <tr>
                          <th>Email</th>
                          <td>{{ $user->email }}</td>
                      </tr>
                      <tr>
                          <th>Telefono</th>
                          <td>{{ $user->phone }}</td>
                      </tr>
                      <tr>
                          <th>Celular</th>
                          <td>{{ $user->cellphone }}</td>
                      </tr>
                      <tr>
                          <th>Direccion</th>
                          <td>{{ $user->address }}</td>
                      </tr>
                      <tr>
                          <th>Documento</th>
                          <td>{{ $user->document }}</td>
                      </tr>
                      <tr>
                          <th>Rol</th>
                          <td>{{$user->roles->implode('name',', ')}}</td>
                      </tr>
                      <tr>
                          <th>Actualizado</th>
                          <td>{{ $user->updated_at }}</strong></td>
                      </tr>
                      <tr>
                          <th>Creado</th>
                          <td>{{ $user->created_at }}</strong></td>
                      </tr>
                  </table>
              </div>
          </div>
    </div>
@endcan
@endsection
