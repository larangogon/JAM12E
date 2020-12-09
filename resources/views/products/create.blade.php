@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <div class="panel-body">
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
@endsection
