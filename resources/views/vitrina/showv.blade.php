@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert-default-success" role="alert">
        <p>{{session('success')}}</p>
    </div>
@endif

@if ($errors->any())
    <div class="alert-default-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
     
<div class="container">
    <div class="content-box-large">
        <div class="panel-heading">
            
            <div class="panel-title">
                <h2>Nombre del producto: {{ $products->name }}
                    <a href="{{ route('/vitrina') }}" class="btn btn-success btn-sm btn:hover">Volver</a>
               </h2></div>
            </div>
            <table class="table table-striped">
            <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                
                  <td>
            <div class="card" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong>Descripcion: {{ $products->description }}</strong></li>
                  <li class="list-group-item"><strong>Precio: {{number_format($products->price)}} </strong></li>
                  <li class="list-group-item"><strong>Stock: {{ $products->stock }}</strong></li>
                  <li class="list-group-item"><strong>Color:  {{$products->colors->implode('name',', ')}}</strong></li>
                  <li class="list-group-item"> <strong>Categoria: {{$products->categories->implode('name',', ')}}</strong></li>
                  <li class="list-group-item"><strong>Talla: {{$products->sizes->implode('name',', ')}}</strong></li>
                </ul>
              </div>
            </td>
    
            <td>
                <strong></strong>
                <br>
                <!-- Mostramos todas las imágenes pertenecientes a a este registro -->
                @foreach($products->imagenes as $img)
                    <a data-fancybox="gallery" href="../../../uploads/{{ $img->name }}">
                        <img src="../../../uploads/{{ $img->name }}" width="200"  class="img-fluid"> 
                    </a> 
                @endforeach

            </td>
            <form action="{{route('cart/add') }}" method="POST">
                @csrf
        <td>
            <h1>Datos para tu compra</h1>
           
          
               
                <div>
                    <div class="form-group">
                        <label for="stock" class="negrita">Elige una cantidad</label>
                        <br>
                        <input type="number" placeholder="0" name="stock" min="1" max="100">
                        @error('stock')
                        {{$message}}
                        @enderror
                        <input type="hidden" value="{{$products->id}}" name="products_id">
                    </div>
    
                    <div class="form-group">
                      <label for="stock" class="negrita">Selecciona un color</label>
                      <select name="color_id" class="form-control">
                          <option selected disabled>elige un color</option>
                          @foreach ($products->colors as $color )
                          <option value="{{ $color->id}}">{{$color->name}}</option>
                          @endforeach
                      </select>
                    </select>
                    @error('color_id')
                    {{$message}}
                    @enderror
                  </div>
    
                  <div class="form-group ">
                    <label for="stock" class="negrita">Selecciona una talla</label>
                    <select name="size_id" class="form-control">
                        <option selected disabled>elige una talla</option>
                        @foreach ($products->sizes as $size )
                        <option value="{{ $size->id}}">{{$size->name}}</option>
                        @endforeach
                    </select>
                    @error('size_id')
                    {{$message}}
                    @enderror
                </div>
            </div>
                <button type="submit" class="btn btn-block btn-sm btn-primary">
                        Agregar al Carrito 
                </button>
            </td>
            </form>
        </tr>
    </tbody>
  </table>
</div>
@endsection