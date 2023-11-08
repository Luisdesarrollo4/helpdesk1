<form id="frmActuializarDatosPersonales" method="POST" onsubmit="return actualizarDatosPersonales()">
    <!-- Modal -->
    <div class="modal fade" id="modalActualizarDatosPersonales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">modalActualizar los Datos Personales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <label for="tipoDocumento">Tipo de documento</label>
                    <input type="text" class="form-control" id="tipoDocumento" name="tipoDocumento">
                    <label for="numeroDocumento">Numero de documentos</label>
                    <input type="text" class="form-control" id="numeroDocumento" name="numeroDocumento">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos">
                    <label for="nombres">nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres">
                    <label for="telefonoinicio">Telefono</label>
                    <input type="text" class="form-control" id="telefonoinicio" name="telefonoinicio">
                    <label for="correoinicio">correo</label>
                    <input type="text" class="form-control" id="correoinicio" name="correoinicio">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-warning">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</form>
