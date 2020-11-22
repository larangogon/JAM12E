@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header">Notificaciones</h5>
                    <div class="card-body">
                        <p class="card-text">
                            @forelse($notifications as $notification)
                                @if($notification->type == 'App\Notifications\ProductNotification')
                                @can('Administrator')
                                    <div class="alert alert-danger" role="alert">
                                        [{{ $notification->created_at }}]<br>
                                        Producto {{ $notification->data['id'] }}<br>
                                        Nombre: {{ $notification->data['name'] }} <br>
                                        stock: ({{ $notification->data['stock'] }})<br>
                                        se agoto este producto.
                                    </div>
                                @endcan
                                @else
                                    <div class="alert alert-success" role="alert">
                                        [{{ $notification->created_at }}]
                                        Mensaje # {{ $notification->data['id'] }}<br>
                                        msg: {{ $notification->data['body'] }} <br>
                                        Enviado a: ({{ $notification->data['recipient_id'] }})<br>
                                        Enviado por: ({{ $notification->data['sender_id'] }})<br>
                                        Nuevo mensaje
                                    </div>
                                @endif
                                @if($loop->last)
                                    <form action="{{route('markNotification', $notification->id ) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn  btn-sm btn-primary">
                                            Marcar como leidas
                                        </button>
                                    </form>
                                @endif
                            @empty
                                There are no new notifications
                            @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
