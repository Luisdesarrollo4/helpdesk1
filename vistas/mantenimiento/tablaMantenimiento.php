        <?php
            // Incluir el archivo de conexión
            include "../../clases/conexion.php";

            // Crear una instancia de la clase de conexión
            $con = new conexion();

            // Establecer la conexión
            $conexion = $con->conectar();

            // Consultar los datos de mantenimiento
            $sql = "SELECT 
                        p.id_persona AS id_usuario,
                        p.apellidos,
                        p.nombres,
                        CONCAT(p.apellidos, ' ', p.nombres) AS usuario,
                        m.fecha,
                        m.descripcion_m,
                        m.responsable 
                    FROM t_persona p
                    INNER JOIN t_mantenimiento m ON p.id_persona = m.id_persona";

            // Ejecutar la consulta
            $respuesta = mysqli_query($conexion, $sql);
        ?>

        <table class="table table-sm dt-responsive nowrap" id="tablaMantenimientoDataTable" style="width:100%">
            <thead>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Descripcion</th>
                <th>Responsable</th>
            </thead>
            <tbody>
                <?php 
                    // Recorrer los resultados de la consulta
                    while ($mostrar = mysqli_fetch_array($respuesta)) {
                ?>
                <tr>
                    <!-- Mostrar los datos de cada fila en las columnas correspondientes -->
                    <td><?php echo $mostrar['usuario']; ?></td>
                    <td><?php echo $mostrar['fecha']; ?></td>
                    <td><?php echo $mostrar['descripcion_m']; ?></td>
                    <td><?php echo $mostrar['responsable']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <script>
            $(document).ready(function(){
                // Inicializar el plugin DataTable en la tabla
                $('#tablaMantenimientoDataTable').DataTable();
            });
        </script>
