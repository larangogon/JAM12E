@extends('layouts.app')
@section('content')
    @can('index.importProduct')
        <div class="container">
            @if (session('success'))
                <div class="alert-default-success" role="alert">
                    <p>
                        {{session('success')}}
                    </p>
                </div>
            @endif
            <h5>
                Importar productos
                <a href="{{ route('products.index') }}" class="btn btn-primary  btn-sm">
                    Volver
                </a>
            </h5>
            <div class="row">
                <div class="col-md-6">
                    <div class="card w-75">
                        <div class="card-body">
                            <h5 class="card-title">
                                Importar Productos
                            </h5>
                            <form method="POST" action="{{route('importProducts')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                                </div>
                                <button type="submit" class="btn btn-success btn-block btn-sm">
                                    Importar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card w-75">
                        <div class="card-body">
                            <h5 class="card-title">
                                Importar imagenes
                            </h5>
                            <form method="POST" action="{{route('imgsProducts')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div>
                                        <input name="imgUp[]" type="file" id="imgUp" multiple="multiple">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-block btn-sm">
                                    Importar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <div class="alert alert-primary" role="alert">
                    1. Todos los productos que se importaran deben tener estado activo (1)!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-danger" role="alert">
                    2. Recuerde importar las imagenes de los productos nuevos, ejemplo: Producto103.jpg,!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-info" role="alert">
                    3. Todos los items son requeridos para crear un producto nuevo y deben existir en la base de datos!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-warning" role="alert">
                    4. Recuerde agregar una coma al final de cada talla, color, categoria e imagen. ejemplo: XS,S,L,!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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
            </div>
        </div>
    @endcan
@endsection
