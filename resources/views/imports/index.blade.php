@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="col-md-6">
            <div class="card w-75">
                <div class="card-body">
                    <h5 class="card-title">
                        Importar Usuarios
                    </h5>
                    <p>
                        <form method="POST" action="{{route('importProducts')}}"
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
    @endcan
@endsection
