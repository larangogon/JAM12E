@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <script type="text/javascript">
            function confirmarEliminar() {
                var x = confirm("Estas seguro de Eliminar?");
                if (x==true)
                {
                    return true;
                }
                else {
                    return false;
                }
            }
        </script>
        <div class="container">
            @if (session('success'))
                <div class="alert-default-success" role="alert">
                    <p>{{session('success')}}</p>
                </div>
            @endif
                <div class="row">
                    <div class="col-md-8">
                        <h2>
                            {!! trans('messages.Created Product') !!}
                        </h2>
                    </div>
                    @can('opciones.avanzadas')
                    <div class="col-md-4">
                        <nav class="mt-2 float-right">
                            <ul class="nav nav-pills nav-sidebar flex-column"
                                data-widget="treeview" role="menu"
                                data-accordion="false">
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <button class="btn btn-outline-secondary btn-sm btn-block">
                                            {!! trans('messages.Advanced Options') !!}
                                        </button>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('exportProducts') }}">
                                                <button type="button" class="btn btn-primary btn-sm btn-block float-right">
                                                    {!! trans('messages.Export Products') !!}
                                                </button>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('indexProducts') }}">
                                                <button type="button" class="btn btn-dark btn-block btn-sm float-right">
                                                    {!! trans('messages.Import Products') !!}
                                                </button>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="products/create">
                                                <button type="button" class="btn btn-success btn-sm btn-block float-right">
                                                    {!! trans('messages.Add Product') !!}
                                                </button>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                @endcan
                <h6>
                    @if($search)
                        <div class="alert-default-primary" role="alert">
                            Los resultados para tu busqueda '{{$search}}' son:
                        </div>
                    @endif
                </h6>
                <table class="table table-sm table-hover table-bordered">
                    <thead>
                    <tr class="table-primary">
                        <th scope="col">#</th>
                        <th>{!! trans('messages.Name') !!}</th>
                        <th>{!! trans('messages.Description') !!}</th>
                        <th>{!! trans('messages.Price') !!}</th>
                        <th>Stock</th>
                        <th>{!! trans('messages.Code') !!}</th>
                        <th>Img</th>
                        <th>Opciones{!! trans('messages.Options') !!}</th>
                        <th>X</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="v-align-middle">{{$product->id}}</td>
                            <td class="v-align-middle">{{$product->name}}</td>
                            <td class="v-align-middle text-truncate" style="max-width: 200px">{{$product->description}}</td>
                            <td class="v-align-middle">$.{{number_format($product->price)}}</td>
                            <td class="v-align-middle">{{$product->stock}}</td>
                            <td class="v-align-middle">{{$product->barcode}}</td>
                            <td class="v-align-middle">
                                <img class="img img:hover"
                                     src="../uploads/{{$product->imagenes()->first()['name']}}"
                                     width="30" class="img-responsive">
                            </td>
                            <td class="v-align-middle">
                                <form action= "{{ route('products.active',  $product->id)}}" method = "POST">
                                    <a href="{{route('products.show', $product->id) }}">
                                        <button type="button" class="btn btn-dark btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    @can('products.edit')
                                        <a href="{{ route('products.edit', $product->id) }}">
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                    @endcan
                                    @can('products.active')
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class=" btn-sm btn {{$product->active ?  'btn-success' : 'btn-danger'}}" role="button" >
                                            {{$product->active ?  'activo' : 'inactivo'}}
                                        </button>
                                    @endcan
                                </form>
                            <td class="v-align-middle">
                                <form action= "{{ route('products.destroy',  $product->id)}}" method = "POST">
                                    @csrf
                                    @method('DELETE')
                                    @can('products.destroy')
                                        <button type="submit" class="btn btn-danger btn-sm"  role="button" onclick="return confirmarEliminar()">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
        <div class="row">
            <div class="mx-auto">
                {{ $products->links()}}
            </div>
        </div>
    </div>
@endsection
