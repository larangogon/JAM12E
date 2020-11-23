@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert-default-success" role="alert">
            <p>{{session('success')}}</p>
        </div>
    @endif
    <div class="row justify-content-center">
        <h2>
            {!! trans('messages.Generated order') !!} N# {{$order->id}}
        </h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-black">
                        <p class="card-text">@include('orders.status')</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th>{!! trans('messages.Name') !!}</th>
                            <td>{{$order->user->name}}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Phone') !!}</th>
                            <td>{{$order->user->phone}}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Cell phone') !!}</th>
                            <td>{{$order->user->cellphone}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$order->user->email}}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Document') !!}</th>
                            <td>{{$order->user->document}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <th># {!! trans('messages.Order') !!}</th>
                            <td>{{$order->id}}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Order total') !!}</th>
                            <td>{{$order->total}}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Order status') !!} </th>
                            <td>{{trans($order->status)}}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Payment status') !!}</th>
                            <td>{{trans($order->payment->status) ?? __('no existe')}}</td>
                        </tr>
                        @if($order->status == 'APROVADO_T')
                            <tr>
                                <th>{!! trans('messages.Expires') !!}</th>
                                <td>{{$order->payment->expiration ?? ('Procesando informacion...')}}</td>
                            </tr>
                        @endif
                        @if($order->status == 'APPROVED')
                            <tr>
                                <th>{!! trans('messages.Expires') !!}</th>
                                <td>{{$order->payment->expiration ?? ('Procesando informacion...')}}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-8">
                <div class="card-body">
                    <div class="card-header ">{!! trans('messages.Purchase detail') !!}</div>
                        <table class="table table-sm">
                            <thead>
                            @foreach($order->details as $detail)
                                <tr class="table-success">
                                    <th>{!! trans('messages.Name') !!}</th>
                                    <th>{!! trans('messages.Size') !!}</th>
                                    <th>Color</th>
                                    <th>{!! trans('messages.Quantity') !!}</th>
                                    <th>subtotal</th>
                                </tr>
                            <thead>
                            <tr>
                                <th class="v-align-middle">{{ $detail->product->name}}</th>
                                <th class="v-align-middle">{{ $detail->size->name}}</th>
                                <th class="v-align-middle">{{ $detail->color->name}}</th>
                                <th class="v-align-middle">{{ $detail->stock}}U</th>
                                <th class="v-align-middle">$.{{ number_format($detail->total) }}</th>
                            </tr>
                            @endforeach
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

