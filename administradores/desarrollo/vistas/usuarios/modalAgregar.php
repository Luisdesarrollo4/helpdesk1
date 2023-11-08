<!-- Modal -->
<form id="frmAgregarUsuario" method="POST" onsubmit="return agregarNuevoUsuario()">
    <div class="modal fade" id="modalAgregarUsuarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- Título del modal -->
                    <h5 class="modal-title" id="exampleModalLabel">adorAgregar Nuevo Usuario</h5>
                    <!-- Botón para cerrar el modal -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="tipo_documento">Tipo de documento</label>
                            <!-- Select para elegir el tipo de documento -->
                            <select class="form-control" id="tipo_documento" name="tipo_documento" required>
                                <option value="">Seleccione una opción</option>
                                <option value="Cedula de ciudadania">Cédula de ciudadanía</option>
                                <option value="Cedula Extranjeria">Cédula de extranjería</option>
                                <option value="Pasaporte">Pasaporte</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="numero_documento">Numero de documento</label>
                            <!-- Input para ingresar el número de documento -->
                            <input type="text" class="form-control" id="numero_documento" name="numero_documento" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="apellidos">Apellidos</label>
                            <!-- Input para ingresar los apellidos -->
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="nombres">Nombres</label>
                            <!-- Input para ingresar los nombres -->
                            <input type="text" class="form-control" id="nombres" name="nombres">
                        </div>
                        <div class="col-sm-4">
                            <label for="telefono">Telefono</label>
                            <!-- Input para ingresar el número de teléfono -->
                            <input type="text" class="form-control" id="telefono" name="telefono">
                        </div>
                        <div class="col-sm-4">
                            <label for="correo">Correo</label>
                            <!-- Input para ingresar el correo electrónico -->
                            <input type="email" class="form-control" id="correo" name="correo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="oficina">Oficina</label>
                            <!-- Input para ingresar la oficina -->
                            <input type="text" class="form-control" id="oficina" name="oficina">
                        </div>
                        <div class="col-sm-4">
                            <label for="usuario">Usuario</label>
                            <!-- Input para ingresar el nombre de usuario -->
                            <input type="text" class="form-control" id="usuario" name="usuario">
                        </div>
                        <div class="col-sm-4">
                            <label for="password">Contraseña</label>
                            <!-- Input para ingresar la contraseña -->
                            <input type="text" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="idRol">Rol de usuario</label>
                            <!-- Select para elegir el rol de usuario -->
                            <select name="idRol" id="idRol" class="form-control" required>
                                <option value="">Seleccione una Opcion</option>
                                <option value="1">Cliente</option>
                                <option value="2">Administrador</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="area">Area</label>
                            <!-- Select para elegir el área -->
                            <select name="area" id="area" class="form-control">
                                <option value="">Seleccione un área</option>
                                <option value="1">Dep. Sistemas</option>
                                <option value="2">Dep. Jurídico</option>
                                <option value="3">Cartera</option>
                                <option value="4">Análisis</option>
                                <option value="5">Gestión Humana</option>
                                <option value="6">Presidencia</option>
                                <option value="7">Global Finanzas</option>
                                <option value="8">Finanzas Centro</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Botón para cerrar el modal sin realizar ninguna acción -->
                    <span class="btn btn-secondary" data-dismiss="modal">Cerrar</span>
                    <!-- Botón para agregar el nuevo usuario -->
                    <button class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</form>
