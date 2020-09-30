@extends('layouts.app')

@section('content')

<div class="row justify-content-center align-items-center">
        
          <div class="row justify-content-center align-items-center">
          
              <h4>
                  {{ __("No autorizado.  Regresar a ") }}<a href="{{ route('home') }}">{{ __("Inicio") }}</a>
              </h4>
          </div>
   
</div>
                    
@endsection