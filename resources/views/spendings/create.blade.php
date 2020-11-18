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
                        <form action="{{route('spendings.store')}}" method="post">
                            @csrf
                            <input type="hidden" name="created_by" value="{{auth()->user()->id}}">

                                <div class="form-group">
                                    <label for="name">
                                        Descripcion
                                    </label>
                                    <textarea class="form-control" name="description" ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="total">
                                        Total
                                    </label>
                                    <input type="text" class="form-control" name="total" placeholder="valor del gasto">
                                </div>

                                <div class="form-group">
                                    <label for="total">
                                        Id del producto
                                    </label>
                                    <input type="text" class="form-control" name="barcode" placeholder="codigo">
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
