@extends('layouts.app')

@section('content')
    @can('Administrator')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>
                    Editar producto: {{ $products->name }}
                </h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-sm-12">
                        <form method="POST" action="{{ route('products.update',$products->id) }}" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @include('products.frm.prt')
                        </form>
                    </div>
                    <div>
                        @if ( !empty ( $products->imagenes) )
                            <span>
                                Imagen(es) Actual(es):
                            </span>
                            <br>
                            @if (session('success'))
                                <div class="alert-default-success" role="alert">
                                    <p>{{session('success')}}</p>
                                </div>
                            @endif
                                @foreach($products->imagenes as $img)
                                    <img src="../../../uploads/{{ $img->name }}" width="200" class="img-fluid">
                                    <form action=" {{route('products/destroyimagen', [$img->id, $products->id])}}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Eliminar
                                        </button>
                                    </form>
                                @endforeach
                            @else
                            Aún no se ha cargado una imagen para este producto
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
