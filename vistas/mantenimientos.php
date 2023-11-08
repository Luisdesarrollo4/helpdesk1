<?php
include "header.php";
if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] == 2) {
?>

<div class="container">
    <div class="card border-0 shadow my-5">
        <div class="card-body p-5">
            <h1 class="fw-light">Mantenimientos</h1>
            <p class="lead">
                <button class="btn btn-primary" data-toggle="modal" data-target="#frmMantenimientoModal"> Mantenimiento </button>
                <form id="frmMantenimiento" method="POST" onsubmit="return mantenimiento()">
                    <div class="modal fade" id="frmMantenimientoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="usuario" class="form-label">Usuario:</label>
                                        <select name="usuario" id="usuario" class="form-select" required>
                                            <option value="">Elige una opción</option>
                                            <!-- Aquí puedes obtener los usuarios de la base de datos y generar las opciones -->
                                            <?php
                                            // Conexión a la base de datos
                                            $conexion = mysqli_connect("localhost", "root", "", "helpdesk1");

                                            // Consulta para obtener los usuarios
                                            $consulta = "SELECT id_persona, nombres, apellidos FROM t_persona";
                                            $resultados = mysqli_query($conexion, $consulta);

                                            // Generar opciones para cada usuario
                                            while ($fila = mysqli_fetch_assoc($resultados)) {
                                                echo "<option value='" . $fila['id_persona'] . "'>" . $fila['nombres'] . " " . $fila['apellidos'] . "</option>";
                                            }

                                            // Cerrar conexión
                                            mysqli_close($conexion);
                                            ?>
                                        </select>
                                        <div class="invalid-feedback">Por favor, selecciona un usuario.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="fecha" class="form-label">Fecha:</label>
                                        <input type="date" name="fecha" id="fecha" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripción:</label>
                                        <textarea name="descripcion" id="descripcion" rows="4" class="form-control" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="responsable" class="form-label">Responsable:</label>
                                        <input type="text" name="responsable" id="responsable" class="form-control" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Guardar Mantenimiento</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div id="tablaMantenimientoLoad"></div>
                </p>
            </div>
        </div>

        <?php
        include "footer.php";
        ?>
            <script src="../public/js/mantenimiento/mantenimiento.js"></script>
        <?php
        } else {
            header("location:../index.html");
        }
        ?>
