<form id="frmEstatusReporte" method="POST" onsubmit="return estatusReporte()">
    <!-- Modal -->
    <div class="modal fade" id="modalEstatusReporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <!-- Campo oculto para almacenar el ID del reporte -->
                    <input type="text" id="idReporte" name="idReporte" hidden>
                    <label for="solucion">Descripción de la solución</label>
                    <label for="estatus">Estatus</label>
                    <select name="estatus" id="estatus" class="form-control">
                        <option value="0">Abierto</option>
                        <option value="1">Cerrado</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar Solucion</button>
                </div>
            </div>
        </div>
    </div>
</form>
