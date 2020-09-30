@extends('layouts.app')

@section('content')
    @if (count(auth()->user()->orders))
        <div class="d-flex flex-wrap justify-content-around">
            @foreach($orders as $order)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-body text-primary">
                            Estado de tu orden N {{$order->id}}
                           : {{$order->status}}
                        </div>
                        <p class="card-text">
                            Orden creada: {{ $order->created_at }}
                            Por un valor de: ${{number_format($order->total)}}
                        </p>
                        <a href="{{route('orders.show', $order->id) }}">
                            <button type="button" class="btn btn-block btn-sm btn-dark">
                                Ver detalle
                            </button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card text-white bg-warning">
            <h3>
                <div class="row justify-content-center align-items-center">
                    Sorry, There are no orders
                </div>
            </h3>
            <div class="row justify-content-center align-items-center">
                <a href="{{route('vitrina.index') }}" class="btn btn-outline-primary">
                    Seguir comprando
                </a>
            </div>
        </div>
    @endif

@endsection
