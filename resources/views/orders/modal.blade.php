@if($order->shipping)
<button type="button" class="btn btn-primary btn-sm btn-block float-right" data-toggle="modal" data-target="#addshipping">
    Datos del envio
</button>

@else
    <div>
        <h5>
            <small>
                {{__('*Completa los datos de envio!!')}}
            </small>
        </h5>
    </div>
    <button type="button" class="btn btn-primary btn-sm btn-block float-right" data-toggle="modal" data-target="#addshipping">
        Formulario para el envio
    </button>
@endif

{!! Form::open(['url' => 'orders']) !!}
{{ Form::token() }}
<div class="modal fade" id="addshipping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Datos de envio
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                @if($order->shipping)
                    <table class="table">
                        <tr>
                            <th>
                                Nombre
                            </th>
                            <td>
                                {{$order->shipping->name_recipient}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                N Documento
                            </th>
                            <td>
                                {{$order->shipping->document_recipient}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Telefono y celular
                            </th>
                            <td>
                                {{$order->shipping->phone_recipient}}-
                                {{$order->shipping->cellphone_recipient}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Dirreccion
                            </th>
                            <td>
                                {{$order->shipping->address_recipient}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Email
                            </th>
                            <td>
                                {{$order->shipping->email_recipient}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Pais
                            </th>
                            <td>
                                {{$order->shipping->country_recipient}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Ciudad
                            </th>
                            <td>
                                {{$order->shipping->city_recipient}}
                            </td>
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
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
