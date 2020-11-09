<h6>
    @if($search)
        <div class="alert-default-primary" role="alert">
          Los resultados para tu busqueda '{{$search}}'son:
        </div>
    @endif
  </h6>

<div class="d-flex flex-wrap justify-content-around">
    @foreach($products as $product)
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
<div class="row">
    <div class="mx-auto">
      {{$products->links()}}
    </div>
</div>
