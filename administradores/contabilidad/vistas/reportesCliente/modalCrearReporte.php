<form method="POST" id="frmNuevoReporte" onsubmit="return agregarNuevoReporte()" enctype="multipart/form-data">
  <!-- Modal -->
  <div class="modal fade" id="modalCrearReporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo Reporte</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Campo de selección para elegir el dispositivo -->
          <label for="idEquipo">Mis Dispositivos</label>

          <?php 
            // Obtiene el ID del usuario almacenado en la sesión
            $idUsuario = $_SESSION['usuario']['id'];
                   
          ?>
          <!-- Campo de texto para describir el problema -->
          <label for="problema">Describe tu problema</label>
          <textarea name="problema" id="problema" class="form-control" required></textarea>
          
          <!-- Campo de selección para elegir la prioridad -->
          <label for="prioridad">Prioridad</label>
          <select name="prioridad" id="prioridad" class="form-control" required>
            <option value="">Escoge tu prioridad</option>
            <option value="ALTA">ALTA</option>
            <option value="MEDIA">MEDIA</option>
            <option value="BAJA">BAJA</option>
          </select>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</form>
