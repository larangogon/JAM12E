<button type="button" class="btn btn-info float-right btn-sm btn-block" data-toggle="modal" data-target="#filter">
    Filtrar
</button>

<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Filtrar reporte de ordenes por fecha
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="{{route('reportOrders')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="negrita">
                            Desde:
                        </label>
                        <div>
                            <input type="date"  class="form-control" name="fechaInicio"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="negrita">
                            Hasta:
                        </label>
                        <div>
                            <input type="date"  class="form-control" name="fechaFinal"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="negrita">
                           Estado:
                        </label>
                        <div>
                            <select class="custom-select"  name="status">
                                <option selected>Elige una opcion</option>
                                <option value="APPROVED">Aprovadas</option>
                                <option value="PENDING">Pendientes</option>
                                <option value="REJECTED">Rechazadas</option>
                                <option value="all">Todos los estados</option>
                            </select>
                        </div>
                    </div>
                        <button class="btn btn-success btn-block btn-sm float-right" type="submit">
                            Generar PDF
                        </button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark btn-sm btn-block" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
