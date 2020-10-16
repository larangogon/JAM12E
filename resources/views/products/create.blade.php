@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel-body">
                        <h2>
                            Crear producto
                        </h2>
                        <section class="example mt-8">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>
                                                {{ $error }}
                                          </li>
                                      @endforeach
                                  </ul>
                              </div>
                            @endif
                           <form action="/products" method="POST" role="form" enctype="multipart/form-data">
                               @csrf
                               <input type="hidden" name="_method" value="POST">
                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                @include('products.frm.prt')
                          </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
