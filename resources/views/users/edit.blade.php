@extends('layouts.app')

@section('content')
    @can('Administrator')
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>{!! trans('messages.Edit user') !!}: {{ $user->name }}</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name">
                                        {!! trans('messages.Name') !!}
                                    </label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name}}" placeholder ="escribe tu nombre">
                                </div>

                                <div class="form-group">
                                    <label for="phone">{!! trans('messages.Phone') !!}</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $user->phone}}" placeholder ="escribe tu phone">
                                </div>

                                <div class="form-group">
                                    <label for="cellphone">
                                        {!! trans('messages.Cell phone') !!}
                                    </label>
                                    <input type="text" class="form-control" name="cellphone" value="{{ $user->cellphone}}" placeholder ="escribe tu cellphone">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="document">
                                        {!! trans('messages.Document') !!}
                                    </label>
                                    <input type="text" class="form-control" name="document" value="{{ $user->document}}" placeholder ="escribe tu document">
                                </div>

                                <div class="form-group">
                                    <label for="address">
                                        {!! trans('messages.Direction') !!}
                                    </label>
                                    <input type="text" class="form-control" name="address" value="{{ $user->address}}" placeholder ="escribe tu address">
                                </div>

                                <div class="form-group">
                                    <label for="email">
                                        Email
                                    </label>
                                    <input type="email" class="form-control"
                                           name="email" value="{{ $user->email}}"
                                           placeholder ="escribe tu email">
                                </div>
                            </div>

                            <div class="col-sm-4">

                                <div class="form-group">
                                  <label for="email">{!! trans('messages.Role') !!}</label>
                                    <select name="rol" class="form-control">
                                        <option selected disabled>
                                            {!! trans('messages.Choose a role for this user') !!}
                                        </option>
                                        @foreach($roles as $role)
                                            @if($user->tieneRol()->contains($role->name))
                                                <option value="{{ $role->id }}" selected>
                                                    {{ $role->name }}
                                                </option>
                                            @else
                                                <option value="{{ $role->id }}">
                                                    {{ $role->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm">
                                    {!! trans('messages.Save Changes') !!}
                                </button>

                                <button type="reset" class="btn btn-danger btn-sm">
                                    {!! trans('messages.Cancel') !!}
                                </button>

                                <a href="{{ route('users.index') }}" class="btn btn-dark btn-sm">
                                    {!! trans('messages.Return') !!}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan
@endsection

