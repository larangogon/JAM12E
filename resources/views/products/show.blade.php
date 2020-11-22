@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container">
            <div class="panel-title">
                <h2>{!! trans('messages.Product name') !!}: {{ $product->name }}
                    <a href="{{ route('products.index') }}" class="btn btn-outline-success  btn-sm">
                        {!! trans('messages.Return') !!}
                    </a>
                </h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="container">
                            <table class="table table-sm">
                                <tr>
                                    <th>{!! trans('messages.Description') !!}</th>
                                    <td>{{ $product->description }}</td>
                                </tr>
                                <tr>
                                    <th>{!! trans('messages.Price') !!}</th>
                                    <td>{{ $product->price }}</td>
                                </tr>
                                <tr>
                                    <th>Stock</th>
                                    <td>{{ $product->stock }}</td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td>{{$product->colors->implode('name',', ')}}</td>
                                </tr>
                                <tr>
                                    <th>{!! trans('messages.Category') !!}</th>
                                    <td>{{$product->categories->implode('name',', ')}}</td>
                                </tr>
                                <tr>
                                    <th>{!! trans('messages.Size') !!}</th>
                                    <td>{{$product->sizes->implode('name',', ')}}</strong></td>
                                </tr>
                                <tr>
                                    <th>{!! trans('messages.Created by') !!}</th>
                                    <td>{{$product->userCreate->name ?? __('no existe este registro')}}</strong></td>
                                </tr>
                                <tr>
                                    <th>{!! trans('messages.Updated by') !!}</th>
                                    <td>{{$product->userUpdate->name ?? __('no existe este registro')}}</strong></td>
                                </tr>
                                <tr>
                                    <th>{!! trans('messages.Updated') !!}</th>
                                    <td>{{ $product->updated_at }}</strong></td>
                                </tr>
                                <tr>
                                    <th>{!! trans('messages.Created') !!}</th>
                                    <td>{{ $product->created_at }}</strong></td>
                                </tr>
                                <tr>
                                    <th>
                                        {!! trans('messages.Code') !!}
                                    </th>
                                    <td>
                                        <div>
                                            {!! DNS1D::getBarcodeHTML($product->barcode, 'CODE11') !!}
                                        </div>
                                        <h6>{{$product->barcode}}</h6>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        @foreach($product->imagenes as $img)
                            <a data-fancybox="gallery" href="../../../uploads/{{ $img->name }}">
                                <img class="img img:hover" src="../../../uploads/{{ $img->name }}" width="200" class="img-fluid">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
