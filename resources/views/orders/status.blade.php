<div>
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
    @switch($order->status)
        @case('pending_pay')
                @switch($order->payment->status)
                    @case('PENDING')
                        <h5>
                            <small>
                                {{__('el estado de tu pago es PENDING')}}
                            </small>
                        </h5>
                        <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                            Verificar el esado de tu orden
                        </a>
                        <form action="{{route('orders.resend')}}" method="post">
                        @csrf
                            <input type="hidden" name="order" value="{{$order->id}}">
                            <p>
                                <small>
                                    {{__('reintenta tu pago!!')}}
                                </small>
                            </p>
                            <button class="btn btn-block btn-sm btn-primary" type="submit">
                                Reintentar Pago
                            </button>
                        </form>
                    @break

                    @case('APPROVED_PARTIAL')
                        <h5>
                            <small>
                                {{__('el estado de tu pago es PENDING')}}
                            </small>
                        </h5>
                        <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                            Verificar el esado de tu orden
                        </a>
                        <form action="{{route('orders.resend')}}" method="post">
                            @csrf
                            <input type="hidden" name="order" value="{{$order->id}}">
                            <p>
                                <small>
                                    {{__('reintenta tu pago!!')}}
                                </small>
                            </p>
                            <button class="btn btn-block btn-sm btn-primary" type="submit" >
                                Reintentar Pago
                            </button>
                        </form>
                    @break

                    @case('FAILED')
                        <h5>
                            <small>
                                {{__('el estado de tu pago es FAILED')}}
                            </small>
                        </h5>

                        <form action="{{route('orders.resend')}}" method="post">
                            @csrf
                            <input type="hidden" name="order" value="{{$order->id}}">
                            <p>
                                <small>
                                    {{__('reintenta tu pago!!')}}
                                </small>
                            </p>
                            <a class= "btn btn-block btn-sm btn-primary" href="{{route('orders.resend',$order->payment->process_Url) }}">
                                Reintentar Pago
                            </a>
                        </form>
                    @break

                    @case('REJECTED')
                        <h5>
                            <small>
                                {{__('El estado de tu pago es REJECTED')}}
                            </small>
                        </h5>
                        <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                            Verificar el esado de tu orden
                        </a>
                       <form action="{{route('orders.resend')}}" method="post">
                            @csrf
                            <input type="hidden" name="order" value="{{$order->id}}">
                            <p>
                                <small>
                                    {{__('reintenta tu pago!!')}}
                                </small>
                            </p>
                            <button class="btn btn-block btn-sm btn-primary" type="submit">
                                Reintenta el pago
                            </button>
                        </form>
                    @break
            @break

            @case('APPROVED')
                <h5>
                    <small>
                        {{__('el estado de tu pago es APROVADO!!')}}
                    </small>
                </h5>
                <a class="btn btn-block btn-sm btn-dark"
                    href="{{route('orders.show', $order->id) }}">
                    Verificar el esado de tu orden
                </a>
                        @switch($order->shippingStatus)
                            @case('0')
                                <p><small>
                                        {{__('Orden en proceso de envio!!')}}
                                    </small>
                                </p>
                                <div>
                                    <h5>
                                        <small>
                                            {{__('*Completa los datos de envio!!')}}
                                        </small>
                                    </h5>
                                </div>
                            @break
                            @case('1')
                                <p>
                                    <small>
                                        {{__('Orden completada-enviada')}}
                                    </small>
                                </p>
                            @break
                        @endswitch
                    @break
                @endswitch
            @break


            @case('APPROVED')
                @switch($order->payment->status)
                    @case('APPROVED')
                        @switch($order->shippingStatus)
                            @case('0')
                            <h5>
                                <small>
                                    {{__('El estado de tu pago es Aprovado!!')}}
                                </small>
                            </h5>
                                <p>
                                    <small>
                                        {{__('Orden en proceso de envio!!')}}
                                    </small>
                                </p>
                                <div>
                                    <h5>
                                        <small>
                                            {{__('*Completa los datos de envio!!')}}
                                        </small>
                                    </h5>
                                </div>
                                <form action="{{route('orders.reversePay')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="order" value="{{$order->id}}">
                                    <button class="btn btn-block btn-sm btn-danger" onclick="return confirmarCancelar()" type="submit" >
                                        Cancelar pago
                                    </button>
                                </form>
                            @break
                            @case('1')
                                <h5>
                                    <small>
                                        {{__('El estado de tu orden es:')}}
                                    </small>
                                </h5>
                                <h5>
                                    <small>
                                        {{__('* Orden Aprovada')}}
                                    </small>
                                </h5>
                                <h5>
                                    <small>
                                        {{__('* Orden Enviada y completada')}}
                                    </small>
                                </h5>
                            @break
                        @endswitch
                    @break
                @endswitch
            @break


            @case('REJECTED')
                @switch($order->payment->status)
                    @case('REJECTED')
                        <h5>
                            <small>
                                {{__('El estado de tu pago esta Pendiente')}}
                            </small>
                        </h5>
                        <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                            Verificar el esado de tu orden
                        </a>
                       <form action="{{route('orders.resend')}}" method="post">
                            @csrf
                            <input type="hidden" name="order" value="{{$order->id}}">
                            <p>
                                <small>
                                    {{__('reintenta tu pago!!')}}
                                </small>
                            </p>
                            <button class="btn btn-block btn-sm btn-primary" type="submit">
                                Reintentar Pago
                            </button>
                        </form>
                    @break
                @endswitch
            @break

        @case('APPROVED_PARTIAL')
            @switch($order->payment->status)
                @case('APPROVED_PARTIAL')
                    <h5>
                        <small>
                            {{__('El estado de tu pago esta Aprovado parcialmente!! Completa tu pago')}}
                        </small>
                    </h5>
                    <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                        Verificar el esado de tu orden
                    </a>
                    <form action="{{route('orders.complete')}}" method="post">
                        @csrf
                        <input type="hidden" name="order" value="{{$order->id}}">
                        <p>
                            <small>
                                {{__('completa tu pago!!')}}
                            </small>
                        </p>
                        <button class="btn btn-block btn-sm btn-primary" type="submit" >
                            Completa tu pago
                        </button>
                    </form>
                @break
            @default
            <h5>
                <small>
                    {{__('Verifica el estado de tu orden')}}
                </small>
            </h5>
            <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                Verificar el esado de tu orden
            </a>
            @break
            @endswitch
        @break


        @case('PENDING')
            @switch($order->payment->status)
                @case('PENDING')
                    <h5>
                        <small>
                            {{__('El estado de tu pago esta pendiente..Verifica el estado de tu ordern!!')}}
                        </small>
                    </h5>
                    <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                        Verificar el esado de tu orden
                    </a>
                   <form action="{{route('orders.resend')}}" method="post">
                        @csrf
                        <input type="hidden" name="order" value="{{$order->id}}">
                        <p>
                            <small>
                                {{__('reintenta tu pago!!')}}
                            </small>
                        </p>
                        <button class="btn btn-block btn-sm btn-primary" type="submit" >
                            Reintentar Pago
                        </button>
                    </form>
                @break
                @case('APPROVED')
                    <h5>
                        <small>
                            {{__('El estado de tu pago esta Aprovado parcialmente!! Completa tu pago')}}
                        </small>
                    </h5>
                    <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                        Verificar el esado de tu orden
                    </a>
                @break
            @default
            <h5>
                <small>
                    {{__('Verifica el estado de tu orden')}}
                </small>
            </h5>
            <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                Verificar el esado de tu orden
            </a>
            @break
            @endswitch
        @break
        @default
            <h5>
                <small>
                    {{__('Verifica el estado de tu orden')}}
                </small>
            </h5>
            <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                Verificar el esado de tu orden
            </a>
        @break
    @endswitch
</div>
