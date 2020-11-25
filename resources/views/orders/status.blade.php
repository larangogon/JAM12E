<div>
    @switch($order->status)
        @case('APROVADO_T')
            <h5>
                <small>
                    {!! trans('messages.The status of your payment is Approved') !!}
                </small>
            </h5>
            <small>
                {!! trans('messages.The payment was executed in the physical store') !!}
            </small>
            <a href="{{ route('reports.show', $order->id) }}">
                <button type="button" class="btn btn-primary btn-block btn-sm ">
                    {!! trans('messages.Invoice') !!}
                </button>
            </a>
        @break
        @case('pending_pay')
            @switch($order->payment->status ?? __('no existe'))
                @case('PENDING')
                    <h5>
                        <small>
                            {!! trans('messages.The status of your payment is Pending') !!}
                        </small>
                    </h5>
                    <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                        {!! trans('messages.Check the status of your order') !!}
                    </a>
                @break

                @case('APPROVED_PARTIAL')
                    <h5>
                        <small>
                            {!! trans('messages.Check the status of your order') !!}
                        </small>
                    </h5>
                    <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                        {!! trans('messages.Check the status of your order') !!}
                    </a>
                    <form action="{{route('orders.resend')}}" method="post">
                        @csrf
                        <input type="hidden" name="order" value="{{$order->id}}">
                        <p>
                            <small>
                                {!! trans('messages.Retry Payment') !!}
                            </small>
                        </p>
                        <button class="btn btn-block btn-sm btn-primary" type="submit" >
                            {!! trans('messages.Retry Payment') !!}
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
                                {!! trans('messages.Retry Payment') !!}
                            </small>
                        </p>
                        <a class= "btn btn-block btn-sm btn-primary" href="{{route('orders.resend',$order->payment->process_Url) }}">
                            {!! trans('messages.Retry Payment') !!}
                        </a>
                    </form>
                @break

                @case('REJECTED')
                    <h5>
                        <small>
                            {!! trans('messages.The status of your payment is Rejected') !!}
                        </small>
                    </h5>
                    <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                        {!! trans('messages.Check the status of your order') !!}
                    </a>
                   <form action="{{route('orders.resend')}}" method="post">
                        @csrf
                        <input type="hidden" name="order" value="{{$order->id}}">
                        <p>
                            <small>
                                {!! trans('messages.Retry Payment') !!}
                            </small>
                        </p>
                        <button class="btn btn-block btn-sm btn-primary" type="submit">
                            {!! trans('messages.Retry Payment') !!}
                        </button>
                    </form>
                @break
            @break

            @case('APPROVED')
                <h5>
                    <small>
                        {!! trans('messages.The status of your payment is Approved') !!}
                    </small>
                </h5>
                <a class="btn btn-block btn-sm btn-dark"
                    href="{{route('orders.show', $order->id) }}">
                    {!! trans('messages.Check the status of your order') !!}
                </a>
                        @switch($order->shippingStatus)
                            @case('0')
                                <p><small>
                                        {!! trans('messages.Order in shipping process') !!}
                                    </small>
                                </p>
                                <div>
                                    <h5>
                                        <small>
                                            {!! trans('messages.Complete the shipping information') !!}
                                        </small>
                                    </h5>
                                </div>
                            @break
                            @case('1')
                                <p>
                                    <small>
                                        {!! trans('messages.Order submitted and completed') !!}
                                    </small>
                                </p>
                            @break
                        @endswitch
                    @break
                @endswitch
            @break


            @case('APPROVED')
                @switch($order->payment->status ?? __('no existe'))
                    @case('APPROVED')
                        @switch($order->shippingStatus)
                            @case('0')
                            <h5>
                                <small>
                                    {!! trans('messages.The status of your payment is Approved') !!}
                                </small>
                            </h5>
                                <p>
                                    <small>
                                        {!! trans('messages.Order in shipping process') !!}
                                    </small>
                                </p>
                                @include('orders.modal')
                            @break
                            @case('1')
                                <h5>
                                    <small>
                                        {!! trans('messages.The status of your order is') !!}
                                    </small>
                                </h5>
                                <h5>
                                    <small>
                                        {!! trans('messages.Order Approved') !!}
                                    </small>
                                </h5>
                                <h5>
                                    <small>
                                        {!! trans('messages.Order submitted and completed') !!}
                                    </small>
                                    <a href="{{ route('reports.show', $order->id) }}">
                                        <button type="button" class="btn btn-primary btn-block btn-sm ">
                                            {!! trans('messages.Invoice') !!}
                                        </button>
                                    </a>
                                </h5>
                            @break
                        @endswitch
                    @break
                @endswitch
            @break


            @case('REJECTED')
                @switch($order->payment->status?? __('no existe'))
                    @case('REJECTED')
                        <h5>
                            <small>
                                {!! trans('messages.The status of your payment is Rejected') !!}
                            </small>
                        </h5>
                        <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                            {!! trans('messages.Check the status of your order') !!}
                        </a>
                       <form action="{{route('orders.resend')}}" method="post">
                            @csrf
                            <input type="hidden" name="order" value="{{$order->id}}">
                            <p>
                                <small>
                                    {!! trans('messages.Retry Payment') !!}
                                </small>
                            </p>
                            <button class="btn btn-block btn-sm btn-primary" type="submit">
                                {!! trans('messages.Retry Payment') !!}
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
                        {!! trans('messages.Check the status of your order') !!}
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
                    {!! trans('messages.Check the status of your order') !!}
                </small>
            </h5>
            <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                {!! trans('messages.Check the status of your order') !!}
            </a>
            @break
            @endswitch
        @break


        @case('PENDING')
            @switch($order->payment->status?? __('no existe'))
                @case('PENDING')
                    <h5>
                        <small>
                            {!! trans('messages.The status of your payment is Pending') !!}{!! trans('messages.Check the status of your order') !!}
                        </small>
                    </h5>
                    <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                        {!! trans('messages.Check the status of your order') !!}
                    </a>
                @break
                @case('APPROVED')
                    <h5>
                        <small>
                            {{__('El estado de tu pago esta Aprovado parcialmente!! Completa tu pago')}}
                        </small>
                    </h5>
                    <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                        {!! trans('messages.Check the status of your order') !!}
                    </a>
                @break
            @default
            <h5>
                <small>
                    {!! trans('messages.Check the status of your order') !!}
                </small>
            </h5>
            <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                {!! trans('messages.Check the status of your order') !!}
            </a>
            @break
            @endswitch
        @break
        @default
            <h5>
                <small>
                    {!! trans('messages.Check the status of your order') !!}
                </small>
            </h5>
            <a class="btn btn-block btn-sm btn-dark" href="{{route('orders.show', $order->id) }}">
                {!! trans('messages.Check the status of your order') !!}
            </a>
        @break
    @endswitch
    @if($order->payment == null)
            <h5>
                <small>
                    {{__('No hay pago para esta orden!!!')}}
                </small>
            </h5>
        @endif
</div>
