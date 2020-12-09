@extends('layouts.app')

@section('content')
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
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
                    <form method="POST" action="{{ route('products.update',$product->id) }}" role="form" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('products.frm.prt')
                    </form>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                            @if ( !empty ( $product->imagenes) )
                            @if (session('success'))
                                <div class="alert-default-danger" role="alert">
                                    <p>{{session('success')}}</p>
                                </div>
                            @endif
                                @foreach($product->imagenes as $img)
                                    <form action=" {{route('products/destroyimagen', [$img->id, $product->id])}}" method="GET">
                                        @csrf
                                        <img src="../../../uploads/{{ $img->name }}" width="200" class="img-fluid">
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            {!! trans('messages.Destroy') !!}
                                        </button>
                                    </form>
                                @endforeach
                            @else
                                {!! trans('messages.An image has not been uploaded for this product yet') !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
