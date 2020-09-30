@extends('layouts.app')

@section('content')
@can('Administrator')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2 class="mt-3">
                    Editar Roles y permisos
                    @include('roles.modal')
                </h2>
                <div class="mt-3 mb-5">
                <div class="row h-50">
                    <div class="col-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tap"
                             role="tablist" aria-orientation="vertical">
                            @foreach($roles as $key => $role)

                                <a class="nav-link" id="v-ills-home-tab" data-toggle="pill"
                                   href="#{{$role->name}}" role="tab" aria-controls="{{$role->name}}" aria-selected="true">
                                    {{$role->name}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach($roles as $key => $role)
                                <div class="tab-pane fade show @if ($key === 0)'active' @endif" id="{{$role->name}}" role="tabpanel"
                                aria-labelledby="v-ills-home-tab">
                                    <form action="{{route('roles.update', $role->id)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <ul class="list-group list-group-scr">
                                            @foreach($permissions as $permission)
                                                <li class="list-group-item" data-spy="scroll">
                                                    <label for="permissions">{{$permission->name}}</label>
                                                    <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                                                           @if($role->hasDirectPermission($permission->name, 'web')) checked @endif>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <button type="submit" class="btn btn-block btn-primary">{{__('actualizar permisos')}}</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            @foreach($roles as $role)
                                <table class="table-responsive-sm">
                                    <tr>
                                        <th>{{$role->name}}</th>
                                        <td>
                                            <form action= "{{ route('roles.destroy',  $role->id)}}" method = "POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm float-right"  role="button" >
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcan
@endsection
