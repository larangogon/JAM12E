@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <a href="{{ route('messages.index') }}" class="btn btn-block btn-outline-success  btn-sm">
                            Volver
                        </a>
                        <div class="container">
                            <table class="table table-sm">
                                <tr>
                                    <th>Enviado a</th>
                                    <td>{{$msg->senderId->name ?? __('no existe este registro')}}</strong></td>
                                </tr>
                                <tr>
                                    <th>Enviado por</th>
                                    <td>{{$msg->recipientId->name ?? __('no existe este registro')}}</strong></td>
                                </tr>
                                <tr>
                                    <th>Menssage</th>
                                    <td>{{ $msg->body }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
