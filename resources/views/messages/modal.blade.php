<button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#addMessage">Enviar mensaje</button>

<div class="modal fade" id="addMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nuevo Mensaje
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('messages.store')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{auth()->user()->id}}" name="sender_id">
                    <div class="form-group">
                        @if(auth()->user()->hasRole('Administrator'))
                        <select name="recipient_id" class="form-control">
                            <option value="Selecciona el usuario"></option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @else
                            <select name="recipient_id" class="form-control">
                                <option value="Selecciona el usuario"></option>
                                @foreach($admins as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="form-group">
                        <textarea name="body" class="form-control" placeholder="Escribe aqui tu mensaje"></textarea>
                    </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Enviar
                    </button>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
