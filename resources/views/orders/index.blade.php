@extends('layouts.app')

@section('content')

@can('Administrator')
<div class="container">

    <script type="text/javascript">
        function confirmarEnvio() {
            var x = confirm("Estas seguro de cambiar el estado del envio?");
            if (x==true)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    </script>
    <script type="text/javascript">
        function confirmarCancelar() {
            var x = confirm("Estas seguro de Eliminar la orden y revertir el pago?");
            if (x==true)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    </script>

    <h2>
        Ordenes
        <a href="{{ route('exportOrders') }}">
            <button type="button" class="btn btn-primary btn-sm float-right">
                Exportar Ordenes
            </button>
        </a>
    </h2>

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
                    <th scope="col">
                        ID
                    </th>
                    <th scope="col">
                        Nombre usuario
                    </th>
                    <th scope="col">
                        Estado
                    </th>
                    <th scope="col">
                        Total
                    </th>
                    <th scope="col">
                        Detalle
                    </th>
                    <th scope="col">
                        Envio
                    </th>
                    <th scope="col">
                        Cancelar pago
                    </th>
                </tr>
              </thead>
              <tbody>
                    @foreach($orders as $order)
                                <tr>
                                    <td>
                                        {{$order->id}}
                                    </td>
                                    <td>
                                        {{$order->user->name}}
                                    </td>
                                    <td>
                                        {{$order->status}}
                                    </td>
                                    <td>
                                        {{number_format($order->total)}}
                                    </td>
                                    <td>
                                        <a href="{{route('orders.show', $order->id) }}">
                                            <button type="button" class="btn btn-dark btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                      <form action= "{{ route('orders.shippingStatus',  $order->id)}}" method = "POST">
                                          @csrf
                                          @method('GET')
                                          <button type="submit" class=" btn-sm btn
                                              {{$order->shippingStatus ?  'btn-success' : 'btn-danger'}}" role="button" onclick="return confirmarEnvio()">
                                              {{$order->shippingStatus ?  'enviado' : 'pendiente'}}
                                          </button>
                                      </form>
                                    </td>
                                    <td>
                                        <form action="{{route('orders.reversePay')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="order" value="{{$order->id}}">
                                            <button class="btn btn-sm btn-danger" onclick="return confirmarCancelar()" type="submit" >
                                                <i class="fas fa-minus-circle"></i>
                                            </button>
                                        </form>
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
