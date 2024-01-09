<!-- Modal para asignar equipo -->
<form id="frmAsignaEquipo" method="POST" onsubmit="return asignarEquipo()">
    <div class="modal fade" id="modalAsignarEquipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asignar equipo</h5>
                        <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Nombre de persona</label>
                                <?php
                                    $sql = "SELECT 
                                        persona.id_persona, 
                                        CONCAT(persona.nombres) AS nombres
                                    FROM 
                                        t_persona AS persona 
                                        INNER JOIN 
                                        t_usuarios AS usuario ON persona.id_persona = usuario.id_persona
                                        
                                    ORDER BY persona.nombres";
                                    $respuesta = mysqli_query($conexion, $sql);
                                ?>
                            <select name="idPersona" id="idPersona" class="form-control" required>
                                <option value="">Seleccione una opción</option>
                                    <?php while($mostrar = mysqli_fetch_array($respuesta)) { ?>
                                        <option value="<?php echo $mostrar['id_persona']; ?>"><?php echo $mostrar['nombres']; ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Tipo de equipo</label>
                            <?php
                                $sql = "SELECT id_equipo, nombre FROM t_cat_equipo ORDER BY nombre";
                                $respuesta = mysqli_query($conexion, $sql);
                            ?>
                            <select name="idEquipo" id="idEquipo" class="form-control" required>
                                <option value="">Seleccione una opción</option>
                                    <?php while($mostrar = mysqli_fetch_array($respuesta)) { ?>
                                <option value="<?php echo $mostrar['id_equipo']; ?>"><?php echo $mostrar['nombre']; ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label for="numeroAsignacion">Número del equipo</label>
                            <input type="text" class="form-control" id="numeroAsignacion" name="numeroAsignacion">
                        </div>
                        <div class="col-sm-4">
                            <label for="marca">Marca</label>
                            <input type="text" name="marca" id="marca" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label for="modelo">Modelo</label>
                            <input type="text" name="modelo" id="modelo" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="serial">Número serial</label>
                            <input type="text" class="form-control" id="serial" name="serial">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-primary">Asignar</button>
                </div>
            </div>
        </div>
    </div>
</form>
