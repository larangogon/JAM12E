@extends('layouts.app')

@section('content')

    @can('Administrator')
        <div class="container">
            <div class="row">
                <div class="col-md-4 mx-auto">
                    <h2>Categorias
                        @include('categories.modal')
                    </h2>
                    <table class="table-sm table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{$category->id}}</th>
                                    <td>{{$category->name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endcan
@endsection
