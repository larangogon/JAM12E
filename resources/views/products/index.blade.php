@extends('layouts.app')

@section('content')
@can('Administrator')
  <div class="panel-body">
      <script type="text/javascript">
          function confirmarEliminar() {
              var x = confirm("Estas seguro de Eliminar?");
              if (x==true)
              {
                  return true;
              }
              else
              {
                  return false;
              }
          }
      </script>
      <div class="container">
        @if(Session::has('message'))
          <div class="alert-default-primary" role="alert">
              {{ Session::get('message') }}
          </div>
        @endif
        <h2>Producto Creados
            <a href="products/create">
                <button type="button" class="btn btn-success btn-sm float-right">
                    Agregar Producto
                </button>
            </a>
            <a href="{{ route('indexProducts') }}">
                <button type="button" class="btn btn-primary btn-sm float-right">
                    importar Productos
                </button>
            </a>
            <a href="{{ route('exportProducts') }}">
                <button type="button" class="btn btn-warning btn-sm float-right">
                    Exportar Productos
                </button>
            </a>
        </h2>
        <h6>
            @if($search)
                <div class="alert-default-primary" role="alert">
                  Los resultados para tu busqueda '{{$search}}' son:
                </div>
            @endif
        </h6>
        <table class="table table-hover table-bordered">
              <thead>
                    <tr class="table-primary">
                      <th scope="col">id</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>price</th>
                      <th>stock</th>
                      <th>imagenes</th>
                      <th>Opciones</th>
                      <th>Otras Opciones</th>
                    </tr>
              </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                  <td class="v-align-middle">
                      {{$product->id}}
                  </td>
                  <td class="v-align-middle">
                      {{$product->name}}
                  </td>
                  <td class="v-align-middle text-truncate" style="max-width: 200px">
                      {{$product->description}}
                  </td>
                  <td class="v-align-middle">
                      {{$product->price}}
                  </td>
                  <td class="v-align-middle">
                      {{$product->stock}}
                  </td>
                  <td class="v-align-middle">
                      <img class="img img:hover" src="../uploads/{{$product->imagenes()->first()['name']}}" width="30" class="img-responsive">
                  </td>
                  <td class="v-align-middle">
                      <form action= "{{ route('products.active',  $product->id)}}" method = "POST">
                          <a href="{{route('products.show', $product->id) }}">
                              <button type="button" class="btn btn-dark btn-sm">
                                  <i class="fas fa-eye"></i>
                              </button>
                          </a>
                          <a href="{{ route('products.edit', $product->id) }}">
                              <button type="button" class="btn btn-primary btn-sm">
                                  <i class="fas fa-edit"></i>
                              </button>
                          </a>
                          @csrf
                          @method('GET')
                          <button type="submit" class=" btn-sm btn
                              {{$product->active ?  'btn-success' : 'btn-danger'}}" role="button" >
                              {{$product->active ?  'activo' : 'inactivo'}}
                          </button>
                      </form>

                      <td class="v-align-middle">
                          <form action= "{{ route('products.destroy',  $product->id)}}" method = "POST">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm"  role="button" onclick="return confirmarEliminar()">
                                  <i class="fas fa-trash-alt"></i>
                              </button>
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
@endcan
@endsection
