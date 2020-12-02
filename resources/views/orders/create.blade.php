@extends('layouts.app')

@section('content')
<div class="container " style="margin-top: 5px">
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-sm-8">
                <h2>
                    <div class="row justify-content-center align-items-center">
                        {!! trans('messages.Purchase detail') !!}
                    </div>
                </h2>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                            <h5>
                                <div class="row justify-content-center align-items-center">{!! trans('messages.User data') !!}</div>
                            </h5>
                                <th>{!! trans('messages.Name') !!}</th>
                                <th>{!! trans('messages.Document') !!}</th>
                                <th>{!! trans('messages.Direction') !!}</th>
                                <th>{!! trans('messages.Cell phone') !!}</th>
                                <th>{!! trans('messages.Phone') !!}</th>
                            </tr>
                        <thead>
                            <tr>
                                <th class="v-align-middle">{{auth()->user()->name}}</th>
                                <th class="v-align-middle">{{auth()->user()->document}}</th>
                                <th class="v-align-middle">{{auth()->user()->address}}</th>
                                <th class="v-align-middle">{{auth()->user()->phone}}</th>
                                <th class="v-align-middle">{{auth()->user()->cellphone}}</th>
                            </tr>
                        </thead>
                    </table>

                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <h5>
                                    <div class="row justify-content-center align-items-center">
                                        @auth {{auth()->user()->cart->productsCount()}}
                                        @endauth {!! trans('messages.Product (s) with a total of') !!} ${{$cart->valorCarrito()}}
                                    </div>
                                </h5>
                            </tr>
                        <thead>
                            @foreach ($cart->products as $product)
                            <tr class="table-success">
                                <td>
                                    <img src= "../uploads/{{$product->imagenes()->first()['name']}}"
                                         width="50" height="50"
                                    />
                                </td>
                                <th class="v-align-middle">{{$product->name }}</th>
                                <th class="v-align-middle">{{$product->pivot->size->name}}</th>
                                <th class="v-align-middle">{{$product->pivot->color->name}}</th>
                                <th class="v-align-middle">$.{{number_format($product->price) }}</th>
                                <th class="v-align-middle">{{$product->pivot->stock }}</th>
                                <th class="v-align-middle">$.{{number_format($product->price * $product->pivot->stock)}}</th>
                            </tr>
                            @endforeach
                        </thead>
                    </table>

                    <table align="right">
                        <th>
                            <div class="badge badge-light text-wrap" style="width: 12rem;">
                                <form action="{{route('orders.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="cart_id" value="{{$cart->id}}">
                                    <button type="submit" class="btn btn-dark btn-block text-left">{!! trans('messages.Pay with PlaceToPay') !!}</button>
                                </form>
                            </div>
                        </th>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@can('Administrator')
    <div class="container">
        <div class="card">
            <h5 class="card-header">{!! trans('messages.Generate payment in store') !!}</h5>
            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                    {!! trans('messages.Authorized payment per store with user presete!') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('orders.paymentInStore')}}" method="post">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{$cart->id}}">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name">
                                    {!! trans('messages.Name') !!}
                                </label>
                                <input type="text" class="form-control" name="name" placeholder="nombre pagador">
                            </div>
                            <div class="form-group">
                                <label for="document">
                                    {!! trans('messages.Document') !!}
                                </label>
                                <input type="text" class="form-control" name="document" placeholder="documento pagador">
                            </div>
                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="text" class="form-control" name="email" placeholder="email pagador">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="mobile">
                                    {!! trans('messages.Cell phone') !!}
                                </label>
                                <input type="text" class="form-control" name="mobile" placeholder="mobil pagador">
                            </div>
                            <div class="form-group">
                                <label for="totalStore">
                                    Total
                                </label>
                                <input type="text" class="form-control" name="totalStore" placeholder="totalStore pagador">
                            </div>
                            <button type="submit" class="btn btn-dark">
                                {!! trans('messages.Generate payment in store') !!}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
    </div>
@endcan
@endsection
