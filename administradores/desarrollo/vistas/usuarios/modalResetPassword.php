<!-- Modal -->
<form id="frmActualizaPassword" onsubmit="return resetPassword()" method="POST">
    <div class="modal fade" id="modalResetPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Título del modal -->
                    <h5 class="modal-title" id="exampleModalLabel">Resetear Contraseña</h5>
                    <!-- Botón para cerrar el modal -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Input oculto para almacenar el ID del usuario -->
                    <input type="text" hidden id="idUsuarioReset" name="idUsuarioReset">
                    <!-- Etiqueta para indicar el propósito del input de contraseña -->
                    <label for="">Actualizar Contraseña</label>
                    <!-- Input para ingresar la nueva contraseña -->
                    <input type="text" id="passwordReset" name="passwordReset" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <!-- Botón para cerrar el modal sin realizar ninguna acción -->
                    <span class="btn btn-secondary" data-dismiss="modal">Cerrar</span>
                    <!-- Botón para cambiar la contraseña -->
                    <button class="btn btn-warning">Cambiar Contraseña</button>
                </div>
            </div>
        </div>
    </div>
</form>
