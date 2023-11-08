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
          <?php 
            // Obtiene el ID del usuario almacenado en la sesión
            $idUsuario = $_SESSION['usuario']['id'];
            
            // Consulta SQL para obtener los dispositivos asignados al usuario
            $sql = "SELECT
                      asignacion.id_asignacion AS idAsignacion,
                      equipo.id_equipo AS idEquipo,
                      equipo.nombre AS nombreEquipo,
                      asignacion.numero_asignacion AS numeroAsignacion
                    FROM
                      t_asignacion AS asignacion
                    INNER JOIN 
                      t_cat_equipo AS equipo ON asignacion.id_equipo = equipo.id_equipo
                    WHERE
                      asignacion.id_persona = (SELECT
                                                id_persona
                                              FROM
                                                t_usuarios
                                              WHERE 
                                                id_usuario = '$idUsuario')";
                  
            // Ejecuta la consulta SQL
            $respuesta = mysqli_query($conexion, $sql);              
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
          
          <label for="area">Area</label>
          <select name="area" id="area" class="form-control" required>
            <option value="">Seleccione el area</option>
            <option value="1">Afianzamiento</option>
            <option value="2">Analisis</option>
            <option value="3">Cartera</option>
            <option value="4">Comercial</option>
            <option value="5">Contabilidad</option>
            <option value="6">Desarrollo</option>
            <option value="7">Gestion Humana</option>
            <option value="8">Juridico</option>
            <option value="10">Sistemas</option>
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
