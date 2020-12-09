@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>
                    {!! trans('messages.Registered Users') !!}
                </h2>
            </div>
            <div class="col-md-4">
                <nav class="mt-2 float-right">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <button class="btn btn-outline-secondary btn-sm btn-block">
                                    {!! trans('messages.Advanced Options') !!}
                                </button>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('exportUsers') }}">
                                        <button type="button" class="btn btn-primary btn-sm btn-block float-right">
                                            {!! trans('messages.Export Users') !!}
                                        </button>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('imports.index') }}">
                                        <button type="button" class="btn btn-dark btn-block btn-sm float-right">
                                            {!! trans('messages.Import Users') !!}
                                        </button>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="users/create">
                                        <button type="button" class="btn btn-success btn-sm btn-block float-right">
                                            {!! trans('messages.Add User') !!}
                                        </button>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <h6>
            @if($search)
                <div class="alert-default-primary" role="alert">
                    Los resultados para tu busqueda '{{$search}}' son:
                </div>
            @endif
        </h6>
        <table class="table table-hover table-bordered table-sm">
            <thead>
            <tr class="table-primary">
                <th scope="col">#</th>
                <th scope="col">{!! trans('messages.Name') !!} </th>
                <th scope="col">{!! trans('messages.Document') !!}</th>
                <th scope="col">Email</th>
                <th scope="col">{!! trans('messages.Role') !!}</th>
                <th scope="col">{!! trans('messages.Options') !!}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->document}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{trans($user->roles->implode('name',', '))}}</td>
                    <td>
                        <form action= "{{ route('users.active',  $user->id)}}" method = "POST">
                            <a href="{{route('users.show', $user->id) }}">
                                <button type="button" class="btn btn-dark btn-sm">
                                    {!! trans('messages.Show') !!}
                                </button>
                            </a>
                            <a href="{{ route('users.edit', $user->id) }}">
                                <button type="button" class="btn btn-primary btn-sm">
                                    {!! trans('messages.Edit') !!}
                                </button>
                            </a>
                            @csrf
                            @method('GET')
                            <button type="submit" class=" btn-sm btn {{$user->active ?  'btn-success' : 'btn-danger'}}" role="button" >{{$user->active ?  'activo' : 'inactivo'}}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="mx-auto">
                {{ $users->links()}}
            </div>
        </div>
    </div>
@endsection
