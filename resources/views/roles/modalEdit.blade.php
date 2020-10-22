<button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#updateRol">
    Eliminar Rol
</button>

{!! Form::open(['url' => 'roles']) !!}
{{ Form::token() }}
<div class="modal fade" id="updateRol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Actualizar roles
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @foreach($roles as $role)
                        <form action= "{{ route('roles.destroy',  $role->id)}}" method = "POST">
                            @csrf
                            @method('DELETE')
                            {{$role->name}}
                            <button type="submit" class="btn btn-danger btn-sm float-right"  role="button" >
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cerrar
                </button>
                <button type="submit" class="btn btn-primary">
                    Actualizar Rol
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
