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
                    <th >Estado</th>
                    <th >ProcessUrl</th>
                    <th >Cancelado</th>
                    <th >Devuelto</th>
                    <th >Gestor</th>
                </thead>
                <tbody>
                @foreach($cancellers as $canceller)
                    <tr>
                        <td>{{$canceller->id}}</td>
                        <td>{{$canceller->status}}</td>
                        <td class="v-align-middle text-truncate">
                            {{$canceller->processUrl}}
                        </td>
                        <td>{{$canceller->created_at}}</td>
                        <td>$.-{{number_format($canceller->amountReturn)}}</td>
                        <td>{{$canceller->user->name}}{{$canceller->user->id}}</td>
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
