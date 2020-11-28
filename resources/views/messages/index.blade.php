@extends('layouts.app')
@section('content')
    <div class="container">
        <h6>
            @if($search)
                <div class="alert-default-primary" role="alert">
                    Los resultados para tu busqueda '{{$search}}' son:
                </div>
            @endif
        </h6>
        @if (session('success'))
            <div class="alert-default-success" role="alert">
                <p>{{session('success')}}</p>
            </div>
        @endif
        <h2>
            @can('Administrator')
             Mensajes
            @endcan
                <a href="{{ route('messages.create') }}">
                    <button type="button" class="btn btn-success btn-sm float-right">
                        Enviar mensaje
                    </button>
                </a>
        </h2>
            @if(auth()->user()->hasRole('Administrator'))

            <table class="table table-sm table-hover table-bordered">
                <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th>Enviado por</th>
                    <th>Enviado a</th>
                    <th>Mensaje</th>
                    <th>ver</th>
                    <th>Responder</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $msg)
                    <tr>
                        <td class="v-align-middle">{{$msg->id}}</td>
                        <td class="v-align-middle">{{$msg->senderId->name}}</td>
                        <td class="v-align-middle">{{$msg->recipientId->name}}</td>
                        <td class="v-align-middle text-truncate" style="max-width: 200px" >{{$msg->body}}</td>
                        <td class="v-align-middle">
                            <a href="{{route('messages.show', $msg->id) }}">
                                <button type="button" class="btn btn-dark btn-sm">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </a>
                        </td>
                        <td class="v-align-middle">
                            <form action= "{{ route('messages.response',  $msg->id)}}">
                                <button type="submit" class="btn btn-success btn-sm"  role="button">
                                    Responder
                                </button>
                            </form>
                        </td>
                        <td class="v-align-middle">
                            <form action= "{{ route('messages.destroy',  $msg->id)}}" method = "POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"  role="button">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <div class="row">
                    <div class="col mb-4">

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="dist/img/151db71a-6864-46b4-8762-a7df6094ca81.jpg" class="d-block w-100" alt="10">
                                </div>
                                <div class="carousel-item">
                                    <img src="dist/img/ede17403-d12a-4c92-b2d3-25f1cf3b0f62.jpg" class="d-block w-100" alt="10">
                                </div>
                                <div class="carousel-item">
                                    <img src="dist/img/872a4654-3661-423d-8b04-a7719eb954ad.jpg" class="d-block w-100" alt="10">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Contactenos
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Canales de comunicacion</h5>
                                <table class="table">
                                    <tr>
                                        <th>whatsapp.</th>
                                        <td>300-213-33-78</td>
                                    </tr>
                                    <tr>
                                        <th>Medellin</th>
                                        <td>489-50-40</td>
                                    </tr>
                                    <tr>
                                        <th>Email.</th>
                                        <td>admin@example.com</td>
                                    </tr>
                                </table>

                                <a href="{{ route('vitrina.index') }}" class="btn btn-primary btn-sm btn-block">Volver</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    </div>
    <div class="row">
        <div class="mx-auto">
            {{ $messages->links()}}
        </div>
    </div>
@endsection
