@extends('layouts.app')

@section('content')

    <a href="{{ route('reportOrders') }}">
        <button type="button" class="btn btn-primary btn-sm float-right">
            Generar archivo PDF order
        </button>
    </a>

    <a href="{{ route('reportProducts') }}">
        <button type="button" class="btn btn-primary btn-sm float-right">
            Generar archivo PDF producr
        </button>
    </a>
@endsection
