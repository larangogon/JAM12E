@extends('layouts.app')

@section('content')
@can('Administrator')
    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <h2>Tallas del producto 
                    @include('sizes.modal')
                </h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sizes as $size)
                            <tr>
                            <th scope="row">{{$size->id}}</th>
                            <td>{{$size->name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endcan
@endsection