@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2>
                        Ordenes canceladas
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
                    <th >Estado</th>
                    <th >RequestId</th>
                    <th >InternalRef</th>
                    <th >ProcessUrl</th>
                    <th >Documento</th>
                    <th >Creado</th>
                    <th >Orden</th>
                    <th >Devuelto</th>
                    <th >Admin</th>
                    <th>Pagador</th></tr>
                </thead>
                <tbody>
                @foreach($cancellers as $canceller)
                    <tr>
                        <td>{{$canceller->id}}</td>
                        <td>{{$canceller->user_id}}</td>
                        <td>{{$canceller->status}}</td>
                        <td>{{$canceller->requestId}}</td>
                        <td class="v-align-middle text-truncate" style="max-width: 100px">
                            {{$canceller->internalReference}}
                        </td>
                        <td class="v-align-middle text-truncate" style="max-width: 100px">
                            {{$canceller->processUrl}}
                        </td>
                        <td>{{$canceller->document}}</td>
                        <td>{{$canceller->created_at}}</td>
                        <td>{{$canceller->order_id}}</td>
                        <td>$.{{number_format($canceller->amountReturn)}}</td>
                        <td>{{$canceller->cancelled_by}}</td>
                        <td>{{$canceller->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="mx-auto">
                    {{ $cancellers->links()}}
                </div>
            </div>
        </div>
    @endcan
@endsection
