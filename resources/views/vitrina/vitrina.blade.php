@extends('layouts.app')

@section('content')

  <div>  
    @if(Session::has('message'))
          <div class="alert-default-primary" role="alert">
              {{ Session::get('message') }}
          </div>
        @endif 
    @include('vitrina.frm.prt') 
  </div>

@endsection
