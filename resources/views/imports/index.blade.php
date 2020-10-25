@extends('layouts.app')

@section('content')
    @can('Administrator')
        @if (session('success'))
            <div class="alert-default-success" role="alert">
                <p>{{session('success')}}</p>
            </div>
        @endif
        <div class="col-md-6">
            <div class="card w-75">
                <div class="card-body">
                    <h5 class="card-title">
                        Importar Usuarios
                    </h5>
                    <p>
                        <form method="POST" action="{{route('import')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="file" class="form-control-file"
                                       id="exampleFormControlFile1">
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">
                                importar
                            </button>
                        </form>
                    </p>
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-block btn-sm">
                        volver
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            @if (isset($errors) && $errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('failures'))
                <table class="table table-danger">
                    <tr>
                        <th>Row</th>
                        <th>Attribute</th>
                        <th>Errors</th>
                        <th>Value</th>
                    </tr>

                    @foreach(session()->get('failures') as $validation)
                        <tr>
                            <td>{{ $validation->row() }}</td>
                            <td>{{ $validation->attribute() }}</td>
                            <td>
                                <ul>
                                    @foreach($validation->errors() as $e)
                                        <li>{{$e}}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                {{ $validation->values()[$validation->atribute()] }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    @endcan
@endsection
