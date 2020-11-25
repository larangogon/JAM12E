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
                <h2>{!! trans('messages.Product name') !!}: {{ $product->name }}
                    <a href="{{ route('vitrina.index') }}" class="btn btn-outline-success btn-sm btn:hover">{!! trans('messages.Return') !!}</a>
               </h2></div>

            </div>
              <div class="row">
                  <div class="col-md-4">
                      <div class="card">
                          <div class="container">

                              {{--Start Rating--}}
                              @for ($i = 0; $i < 5; $i++)
                                  @if (floor($total) - $i >= 1)
                                      {{--Full Start--}}
                                      <i class="fas fa-star text-warning"> </i>
                                  @elseif ($total - $i > 0)
                                      {{--Half Start--}}
                                      <i class="fas fa-star-half-alt text-warning"> </i>
                                  @else
                                      {{--Empty Start--}}
                                      <i class="far fa-star text-warning"> </i>
                                  @endif
                              @endfor
                              {{--End Rating--}}
                              @if($total == 1)
                                  ({{$total}} Promedio)
                              @else($total > 1)
                                  ({{$total}} Promedio)
                              @endif

                          </div>
                      </div>
                      <div class="card">
                      <table class="table table-sm">
                          <tr>
                              <th>{!! trans('messages.Description') !!}</th>
                              <td>{{ $product->description }}</td>
                          </tr>
                          <tr>
                              <th>{!! trans('messages.Price') !!}</th>
                              <td>${{number_format($product->price) }}</td>
                          </tr>
                          <tr>
                              <th>Stock</th>
                              <td>{{ $product->stock }}</td>
                          </tr>
                          <tr>
                              <th>Color</th>
                              <td>{{$product->colors->implode('name',', ')}}</td>
                          </tr>
                          <tr>
                              <th>{!! trans('messages.Category') !!}</th>
                              <td>{{$product->categories->implode('name',', ')}}</td>
                          </tr>
                          <tr>
                              <th>{!! trans('messages.Size') !!}</th>
                              <td>{{$product->sizes->implode('name',', ')}}</strong></td>
                          </tr>
                          <tr>
                              <th>{!! trans('messages.Qualification') !!}</th>
                              <td><form action="{{route('rate', $product) }}" method="POST">
                                  @csrf
                                      <lave>1</lave><input name="score" value="1" type="radio"/>
                                      <lave>2</lave><input name="score" value="2" type="radio"/>
                                      <lave>3</lave><input name="score" value="3" type="radio"/>
                                      <lave>4</lave><input name="score" value="4" type="radio"/>
                                      <lave>5</lave><input name="score" value="5" type="radio" checked="checked"/>
                                      <button type="submit"  class="btn btn-primary btn-sm">{!! trans('messages.Send') !!}</button>
                                  </form>
                              </td>
                          </tr>
                      </table>
                      </div>
                      <div class="card">
                          <div class="container">
                              <div>
                                  <br>
                                  {!! DNS1D::getBarcodeHTML($product->barcode, 'CODE11') !!}
                              </div>
                              <h6>{{$product->barcode}}</h6>
                          </div>
                      </div>
                  </div>

                  <div class="col-md-3">
                      <div class="card-body">
                          @foreach($product->imagenes as $img)
                              <a data-fancybox="gallery" href="../../../uploads/{{ $img->name }}">
                                  <img class="img img:hover" src="../../../uploads/{{ $img->name }}" width="200"  class="img-fluid">
                              </a>
                          @endforeach
                      </div>
                  </div>
                  <div class="col-md-5">
                      <div class="card-body">
                        <form action="{{route('cart/add') }}" method="POST">
                        @csrf

                        <h2>{!! trans('messages.Details for your purchase') !!}</h2>
                            <table class="table">
                                <tr>
                                    <th>{!! trans('messages.Choose a quantity') !!}</th>
                                    <td>
                                        <input type="number" placeholder="0" name="stock" min="1" max="100">
                                        @error('stock')
                                        {{$message}}
                                        @enderror
                                        <input type="hidden" value="{{$product->id}}" name="products_id">
                                        <input type="hidden" value="{{$product->categories[0]->id}}" name="category_id">
                                    </td>
                                </tr>

                                <tr>
                                    <th>{!! trans('messages.Select a color') !!}</th>
                                    <td>
                                        <select name="color_id" class="form-control">
                                            <option selected disabled>{!! trans('messages.Select a color') !!}</option>
                                            @foreach ($product->colors as $color )
                                                <option value="{{ $color->id}}">{{$color->name}}</option>
                                            @endforeach
                                        </select>
                                        </select>
                                        @error('color_id')
                                        {{$message}}
                                        @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <th>{!! trans('messages.Select a size') !!}</th>
                                    <td>
                                        <select name="size_id" class="form-control">
                                            <option selected disabled>{!! trans('messages.Select a size') !!}</option>
                                            @foreach ($product->sizes as $size )
                                                <option value="{{ $size->id}}">{{$size->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('size_id')
                                        {{$message}}
                                        @enderror
                                    </td>
                                </tr>
                            </table>
                            <button type="submit" class="btn btn-block btn-sm btn-primary">
                                {!! trans('messages.Add to cart') !!}
                            </button>
                    </form>
                  </div>
              </div>
          </div>
    </div>
</div>
@endsection
