    <?php 
        session_start();
        include "../../clases/conexion.php";
        
        // Crear una instancia de la clase de conexión
        $con = new Conexion();
        $conexion = $con->conectar();
        
        // Obtener el ID del usuario almacenado en la sesión
        $idUsuario = $_SESSION['usuario']['id'];
        $contador = 1;
        
        // Consulta SQL para obtener los reportes
        $sql = "SELECT
                    reporte.id_reporte AS idReporte,
                    reporte.id_usuario AS idUsuario,
                    CONCAT(
                        persona.apellidos,
                        ' ',
                        persona.nombres
                    ) AS nombrePersona,
                    equipo.id_equipo AS idEquipo,
                    equipo.nombre AS nombreEquipo,
                    asignacion.numero_asignacion AS numeroAsignacion,
                    reporte.descripcion_problema AS problema,
                    reporte.estatus AS estatus,
                    reporte.solucion_problema AS solucion,
                    reporte.fecha AS fecha,
                    reporte.prioridad AS prioridad
                FROM
                    t_reportes AS reporte
                INNER JOIN t_usuarios_humana AS usuario
                ON
                    reporte.id_usuario = usuario.id_usuario_ges
                INNER JOIN t_persona AS persona
                ON
                    usuario.id_persona = persona.id_persona
                INNER JOIN t_asignacion AS asignacion 
                ON 
                    reporte.id_equipo = asignacion.id_equipo
                INNER JOIN t_cat_equipo AS equipo
                ON
                    reporte.id_equipo = equipo.id_equipo
                ORDER BY reporte.fecha DESC";
                
        // Ejecutar la consulta SQL
        $respuesta = mysqli_query($conexion, $sql);
    ?>

    <table class="table table-bordered table-sm dt-responsive nowrap" id="tablaReportesAdminDataTable" style="width:100%">
        <thead>
            <th>#</th>
            <th>Persona</th>
            <th>Dispositivo</th>
            <th>Número Asignación</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Prioridad</th>
            <th>Estatus</th>
            <th>Solución</th>
            <th>Eliminar</th>
            <th>Bitácoras</th>
        </thead>
            <tbody>
                <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
            <tr>
                <td><?php echo $contador++; ?></td>
                <td><?php echo $mostrar['nombrePersona']; ?></td>
                <td><?php echo $mostrar['nombreEquipo']; ?></td>
                <td><?php echo $mostrar['numeroAsignacion'];?></td>
                <td><?php echo $mostrar['fecha']; ?></td>
                <td><?php echo $mostrar['problema']; ?></td>
                <td><?php echo $mostrar['prioridad'];?></td>
                <td>
            <?php  
                        $estatus = $mostrar['estatus'];
                        $cadenaEstatus = '<span class="badge badge-danger">Abierto</span>';
                        if ($estatus == 1) {
                            $cadenaEstatus = '<span class="badge badge-success">Cerrado</span>';
                        }
                        echo $cadenaEstatus;
                    ?>
                </td>
                <td>
                    <button class="btn btn-info btn-sm" 
                    onclick="obtenerDatosSolucion('<?php echo $mostrar['idReporte'];?>')"
                    data-toggle="modal" data-target="#modalAgregarSolucionReporte">
                    Solución
                    </button>
                    <?php echo $mostrar['solucion'] ?>
                </td>
                <td>
                    <?php 
                        if($mostrar['solucion'] == ""){                      
                    ?>
                    <button class="btn btn-danger btn-sm" 
                    onclick="eliminarReporteAdmin('<?php echo $mostrar['idReporte']?>')">
                        Eliminar
                    </button>
                    <?php 
                        }
                    ?>
                </td>
                <td>
                    <a class="btn btn-outline-danger far fa-file-pdf" href="generarpdf.php?idUsuario=<?php echo $mostrar['idUsuario']; ?>"> PDF </a>
                </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    <script>
        $(document).ready(function(){
            $('#tablaReportesAdminDataTable').DataTable(); // Inicializa la tabla de usuarios con DataTable
        });
    </script>