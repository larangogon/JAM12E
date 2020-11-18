@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container col-md-6">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <h5 class="card-header">Generar
                    <a href="{{ route('spendings.index') }}" class="btn btn-outline-success float-right btn-sm">
                        Volver
                    </a>
                </h5>
                <div class="card-body">
                    <form action="{{route('spendings.update', $spending->id)}}" method="POST" role="form" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <input type="hidden" name="updated_by" value="{{auth()->user()->id}}">

                        <div class="form-group">
                            <label for="name">
                                Descripcion
                            </label>
                            <input class="form-control" type="text" name="description" value="{{ $spending->description}}">
                        </div>
                        <div class="form-group">
                            <label for="total">
                                Total
                            </label>
                            <input type="text" class="form-control" name="total" value="{{ $spending->total}}">
                        </div>
                        <div class="form-group">
                            <label for="total">
                                Id del producto
                            </label>
                            <input type="text" class="form-control" name="total" value="{{ $spending->product ?? ('no es un gasto de insumo')}}">
                        </div>
                        <button type="submit" class="btn btn-dark">
                            Generar
                        </button>

                    </form>
                </div>
            </div>
        </div>
        </div>
    @endcan
@endsection
