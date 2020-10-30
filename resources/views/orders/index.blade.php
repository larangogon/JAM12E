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
                        Ordenes
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7">
                    <form>
                        <div class="form-group">
                            <label>
                                Desde:
                                <input type="date" name="fecha_inicio"/>
                            </label>
                            <label>
                                Hasta:
                                <input type="date" name="fecha_final"/>
                            </label>
                            <button class="btn btn-success btn-sm">Filtrar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <a href="{{ route('exportOrders') }}">
                        <button type="button" class="btn btn-dark btn-sm float-right">
                            Exportar
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
            <table class="table table-hover table-bordered">
                <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Total</th>
                    <th scope="col">Detalle</th>
                    <th scope="col">Pago</th>
                    <th scope="col">Actualizado</th>
                    <th scope="col">Envio</th>
                    <th scope="col">Factura</th>
                    <th scope="col">Eliminar</th>
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
                        <td>{{$order->payment->status}}</td>
                        <td>{{$order->payment->updated_at}}</td>


                        <td>
                            @if($order->status == 'APPROVED')
                                <form action= "{{ route('orders.shippingStatus',  $order->id)}}" method = "POST">
                                    @csrf
                                    @method('GET')
                                    <button type="submit" class="btn-sm btn {{$order->shippingStatus ?  'btn-success' : 'btn-danger'}}" role="button" onclick="return confirmarEnvio()">
                                        {{$order->shippingStatus ?  'enviado' : 'pendiente'}}
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
