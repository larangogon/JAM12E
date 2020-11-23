@if($order->shipping)
<button type="button" class="btn btn-primary btn-sm btn-block float-right" data-toggle="modal" data-target="#addshipping">
    {!! trans('messages.Datos del envio') !!}
</button>
<small>
    {{__('Genera factura de tu compra')}}
</small>
<a href="{{ route('reports.show', $order->id) }}">
    <button type="button" class="btn btn-success btn-block btn-sm float-right">
        {!! trans('messages.Invoice') !!}
    </button>
</a>

@else
    <div>
        <h5>
            <small>
                {!! trans('messages.Complete the shipping information') !!}
            </small>
        </h5>
    </div>
    <button type="button" class="btn btn-primary btn-sm btn-block float-right" data-toggle="modal" data-target="#addshipping">
        {!! trans('messages.Formulario para el envio') !!}
    </button>
@endif

{!! Form::open(['url' => 'shipping']) !!}
{{ Form::token() }}
<div class="modal fade" id="addshipping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {!! trans('messages.Datos del envio') !!}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                @if($order->shipping)
                    <table class="table">
                        <tr>
                            <th>{!! trans('messages.Name') !!}</th>
                            <td>{{$order->shipping->name_recipient}}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Document') !!}</th>
                            <td>{{$order->shipping->document_recipient}}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Phone') !!}, {!! trans('messages.Cell phone') !!}</th>
                            <td>{{$order->shipping->phone_recipient}}-{{$order->shipping->cellphone_recipient}}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Direction') !!}</th>
                            <td>{{$order->shipping->address_recipient}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$order->shipping->email_recipient}}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Country') !!}</th>
                            <td>{{$order->shipping->country_recipient}}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.City') !!}</th>
                            <td>{{$order->shipping->city_recipient}}</td>
                        </tr>
                    </table>

                @else
                    @switch($order->status)
                        @case('APPROVED')
                        <p>
                            <small>
                                {{__('')}}
                            </small>
                            @include('shipping.create')
                        </p>
                        @break
                    @endswitch
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    {!! trans('messages.Return') !!}
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
