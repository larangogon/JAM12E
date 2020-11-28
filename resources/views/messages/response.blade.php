@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container">
            @if (session('success'))
                <div class="alert-default-success" role="alert">
                    <p>{{session('success')}}</p>
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Responder mensaje
                        </div>
                        <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('messages.store')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{auth()->user()->id}}" name="sender_id">
                            <input type="hidden" value="{{$msg->sender_id}}" name="recipient_id">
                            <table class="table table-sm">
                                <tr>
                                    <th>Enviado por:</th>
                                    <td>{{$msg->senderId->name}}</td>
                                </tr>
                                <tr>
                                    <th>Mensaje</th>
                                    <td>{{$msg->body}}</td>
                                </tr>
                                <tr>
                                    <th>Respuesta</th>
                                    <td><textarea name="body" class="form-control" placeholder="Escribe aqui tu mensaje"></textarea></td>
                                </tr>
                            </table>

                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-sm btn-primary">
                                    Enviar
                                </button>
                                <a href="{{ route('messages.index') }}" class="btn btn-block btn-sm btn-dark">
                                    Volver
                                </a>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
