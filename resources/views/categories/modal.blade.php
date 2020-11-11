<button type="button" class="btn btn-warning btn-sm float-right" data-toggle="modal" data-target="#addCategory">
    Crear Categoria
</button>

{!! Form::open(['url' => 'categories']) !!}
{{ Form::token() }}
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Nueva Categoria de Articulo
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">
                            Nombre de la categoria:
                        </label>
                        <input name="name" type="text" class="form-control" id="recipient-name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cerrar
                </button>
                <button type="submit" class="btn btn-primary">
                    Guardar Categoria
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
