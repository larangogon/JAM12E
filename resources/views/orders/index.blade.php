@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container">
            <script type="text/javascript">
                function confirmarEnvio() {
                    var x = confirm("Estas seguro de cambiar el estado del envio?");
                    if (x==true) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
            </script>
            <script type="text/javascript">
                function confirmarCancelar() {
                    var x = confirm("Estas seguro de Eliminar la orden y revertir el pago?");
                    if (x==true) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
            </script>

            <div class="row">
                <div class="col-md-8">
                    <h2>
                        {!! trans('messages.Orders') !!}
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('exportOrders') }}">
                        <button type="button" class="btn btn-dark btn-sm float-right">
                            {!! trans('messages.Export') !!}
                        </button>
                    </a>
                </div>
            </div>
            <h6>
                @if($search)
                    <div class="alert alert-primary" role="alert">
                        Los resultados para tu busqueda '{{$search}}' son:
                    </div>
                @endif
            </h6>
            <table class="table table-sm table-hover table-bordered">
                <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">{!! trans('messages.User') !!}</th>
                    <th scope="col">{!! trans('messages.Estatus') !!}</th>
                    <th scope="col">Total</th>
                    <th scope="col">{!! trans('messages.Detail') !!}</th>
                    <th scope="col">{!! trans('messages.Payment') !!}</th>
                    <th scope="col">{!! trans('messages.Updated') !!}</th>
                    <th scope="col">{!! trans('messages.Shipping') !!}</th>
                    <th scope="col">{!! trans('messages.Invoice') !!}</th>
                    <th scope="col">{!! trans('messages.Destroy') !!}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->status}}</td>
                        <td>$.{{number_format($order->total)}}</td>
                        <td>
                            <a href="{{route('orders.show', $order->id) }}">
                                <button type="button" class="btn btn-dark btn-sm">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </a>
                        </td>
                        <td>{{$order->payment->status ?? __('no existe')}}</td>
                        <td>{{$order->payment->updated_at ?? __('no existe')}}</td>


                        <td>
                            @if($order->status == 'APPROVED')
                                <form action= "{{ route('orders.shippingStatus',  $order->id)}}" method = "POST">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="btn-sm btn {{$order->shippingStatus ?  'Enviado' : 'btn-danger'}}" role="button" onclick="return confirmarEnvio()">
                                        {{$order->shippingStatus ?  'Enviado' : 'pendiente'}}
                                    </button>
                                </form>
                            @endif
                        </td>
                        <td>
                            @if($order->status == 'APPROVED')
                                <a href="{{ route('reports.show', $order->id) }}">
                                    <button type="button" class="btn btn-primary btn-sm ">
                                        Factura
                                    </button>
                                </a>
                            @endif
                            @if($order->status == 'APROVADO_T')
                                <a href="{{ route('reports.show', $order->id) }}">
                                    <button type="button" class="btn btn-primary btn-sm ">
                                        Factura
                                    </button>
                                </a>
                            @endif
                        </td>
                        <td>
                            @if($order->status == 'APPROVED')
                                @if($order->shippingStatus == '0')
                                    <form action="{{route('orders.reversePay')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="order" value="{{$order->id}}">
                                        <button class="btn btn-sm btn-danger" onclick="return confirmarCancelar()" type="submit" >
                                            <i class="fas fa-minus-circle"></i>
                                        </button>
                                    </form>
                                @endif
                            @endif
                            @if($order->status == 'APROVADO_T')
                                <form action="{{route('cancellerOrderStore')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="order" value="{{$order->id}}">
                                    <button class="btn btn-sm btn-danger" onclick="return confirmarCancelar()" type="submit" >
                                        <i class="fas fa-minus-circle"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="mx-auto">
                    {{ $orders->links()}}
                </div>
            </div>
        </div>
    @endcan
@endsection
