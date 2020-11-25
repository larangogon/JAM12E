@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="col-md-6">
            <div class="container">
                <h1 class="display-4">{{ $user->name}}
                    <a href="{{ route('users.index') }}" class="btn btn-dark btn-sm">
                        {!! trans('messages.Return') !!}
                    </a>
                </h1>
                <div class="card" >
                    <table class="table">
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Phone') !!}</th>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Cell phone') !!}</th>
                            <td>{{ $user->cellphone }}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Direction') !!}</th>
                            <td>{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Document') !!}</th>
                            <td>{{ $user->document }}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Role') !!}</th>
                            <td>{{trans($user->roles->implode('name',', '))}}</td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Updated') !!}</th>
                            <td>{{ $user->updated_at }}</strong></td>
                        </tr>
                        <tr>
                            <th>{!! trans('messages.Created') !!}</th>
                            <td>{{ $user->created_at }}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    @endcan
@endsection
