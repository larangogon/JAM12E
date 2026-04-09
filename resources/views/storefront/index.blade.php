@extends('layouts.app')

@section('content')
  <div>
      @if (session('success'))
          <div class="alert-default-success" role="alert">
              <p>{{session('success')}}</p>
          </div>
      @endif
    @include('storefront.frm.prt')
  </div>
@endsection
