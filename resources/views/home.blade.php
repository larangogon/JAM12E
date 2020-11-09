@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="dist/img/872a4654-3661-423d-8b04-a7719eb954ad.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="dist/img/872a4654-3661-423d-8b04-a7719eb954ad.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="dist/img/872a4654-3661-423d-8b04-a7719eb954ad.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div>
  </div>

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header ">Bienvenido</div>

                  <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif
                      Estás conectado {{auth()->user()->name}}!
                  </div>
              </div>
          </div>
      </div>
  </div>


  <div class="d-flex flex-wrap justify-content-around">
    <div class= "card mb-3"  style="width: 14rem;">
      <img src="dist/img/61ccdf3a04bb750129a9805e246d1a22.jpg" style="width: 14rem;" alt="20">
      <div class="card-img-overlay">
        <h5 class="card-title"><form action="{{route('vitrina.index')}}" method="get">
          <input type="text" name="category" id="" value="Mujer" hidden>
          <button type="submit" class="btn btn-link">Mujer</button>
      </form></h5>
      </div>
    </div>

    <div class= "card mb-3" style="width: 14rem;">
      <img src="dist/img/3449bfd35ccc40a54deb30e3d613275f.jpg" style="width: 14rem;" alt="20">
      <div class="card-img-overlay">
        <h5 class="card-title"><form action="{{route('vitrina.index')}}" method="get">
          <input type="text" name="category" id="" value="Hombre" hidden>
          <button type="submit" class="btn btn-link">Hombre</button>
      </form></h5>
      </div>
    </div>

    <div class= "card mb-3" style="width: 14rem;">
      <img src="dist/img/2740de713615d74d2e9a4814040f88a5.jpg" style="width: 14rem;" alt="20">
      <div class="card-img-overlay">
        <form action="{{route('vitrina.index')}}" method="get">
          <input type="text" name="category" id="" value="Hogar" hidden>
          <button type="submit" class="btn btn-link">Hogar</button>
      </form>
      </div>
    </div>
  </div>
<div class="row justify-content-center"><h3>Productos mas visitados</h3></div>
<div class="d-flex flex-wrap justify-content-around">
    @foreach($visit as $product  )
        <div class="card cart:hover" style="width: 14rem; " >
            <img src="../uploads/{{$product->imagenes()->first()['name']}}" style="width:100%"
                 class= "card-img-top">
            <div class="card-body">
                <h6 class="card-title">{{$product->name}} <br>
                    Precio: ${{number_format($product->price)}}
                </h6>
                <a href="{{route('vitrina.show', $product->id) }}">
                    <button type="button" class="btn btn-block btn-sm btn-dark btn:hover" >Ver con detalle.</button>
                </a>
            </div>
        </div>
    @endforeach
</div>
<div class="row justify-content-center"><h3>Productos mas comprados</h3></div>
<div class="d-flex flex-wrap justify-content-around">
    @foreach($sales as $product)
        <div class="card cart:hover" style="width: 14rem; " >
            <img src="../uploads/{{$product->imagenes()->first()['name']}}" style="width:100%"
                 class= "card-img-top">
            <div class="card-body">
                <h6 class="card-title">{{$product->name}} <br>
                    Precio: ${{number_format($product->price)}}
                </h6>
                <a href="{{route('vitrina.show', $product->id) }}">
                    <button type="button" class="btn btn-block btn-sm btn-dark btn:hover" >Ver con detalle.</button>
                </a>
            </div>
        </div>
    @endforeach
</div>
<div class="row justify-content-center"><h3>Productos mejor calificados</h3></div>
<div class="d-flex flex-wrap justify-content-around">
    @foreach($rating as $product)
        <div class="card cart:hover" style="width: 14rem; " >
            <img src="../uploads/{{$product->rateable->imagenes()->first()['name']}}" style="width:100%"
                 class= "card-img-top">
            <div class="card-body">
                <h6 class="card-title">{{$product->rateable->name}} <br>
                    Precio: ${{number_format($product->rateable->price)}}
                </h6>
                <a href="{{route('vitrina.show', $product->rateable->id) }}">
                    <button type="button" class="btn btn-block btn-sm btn-dark btn:hover" >Ver con detalle.</button>
                </a>
            </div>
        </div>
    @endforeach
</div>

@endsection
