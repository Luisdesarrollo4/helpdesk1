

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
                reporte.id_reporte_general AS idReporte,
                reporte.id_usuario AS idUsuario,
                CONCAT(
                    persona.apellidos,
                    ' ',
                    persona.nombres
                ) AS nombrePersona,
                reporte.descripcion_general AS problema,
                    reporte.estatus_general AS estatus,
                    reporte.solucion_general AS solucion,
                    reporte.fecha_general AS fecha,
                    reporte.fecha_cierre AS fecha_cierre,
                    reporte.prioridad_general AS prioridad,
                    areas.Nombre AS area

            FROM
                t_reportes_general AS reporte
            INNER JOIN t_usuarios AS usuario
            ON
                reporte.id_usuario = usuario.id_usuario
            INNER JOIN t_persona AS persona
            ON
                usuario.id_persona = persona.id_persona
            LEFT JOIN areas ON reporte.id_area = areas.ID
            WHERE reporte.id_area = 2 OR reporte.id_area_envio = 2
            ORDER BY reporte.fecha_general DESC
            ";
            
            
    // Ejecutar la consulta SQL
    $respuesta = mysqli_query($conexion, $sql);

    // Almacenar los registros en un arreglo
    $reportes = mysqli_fetch_all($respuesta, MYSQLI_ASSOC);
?>

<table class="table table-bordered table-sm dt-responsive nowrap tabla-reportes" id="tablaReportesAdminDataTable" style="width:100%">
    <thead>
        <th>#</th>
        <th>Persona</th>
        <th>Fecha</th>
        <th>Descripción</th>
        <th>Prioridad</th>
        <th>Estatus</th>
        <th>fecha de cierre</th>
        <th>Area</th>
        <th>Solución</th>
        <th>Eliminar</th>
        <th>Bitácoras</th>
        <th>Chat</th>
    </thead>
    <tbody>
        <?php foreach ($reportes as $mostrar) { ?>
        <tr>
            <td><?php echo $contador++; ?></td>
            <td><?php echo $mostrar['nombrePersona']; ?></td>
            <td><?php echo $mostrar['fecha']; ?></td>
            <td><?php echo $mostrar['problema']; ?></td>
            <td><?php echo $mostrar['prioridad']; ?></td>
            <td>
                <?php  
                // Verifica el estatus del reporte y muestra un badge con el estado correspondiente
                $fechaCierre = $mostrar['fecha_cierre'];
                $estatus = $mostrar['estatus'];
                $cadenaEstatus = '<span class="badge badge-danger">Abierto</span>';
                if ($estatus == 1) {
                    $cadenaEstatus = '<span class="badge badge-success">Cerrado</span>';
                } elseif ($fechaCierre && time() > strtotime($fechaCierre)) {
                    $this->actualizarSolucion(array(
                        'idReporte' => $mostrar['idReporte'],
                        'solucion' => 'Cerrado automáticamente por el sistema debido a la prioridad y la fecha de cierre.',
                        'estatus' => 1
                    ));
                    $cadenaEstatus = '<span class="badge badge-success">Cerrado</span>';
                }
                echo $cadenaEstatus;
                ?>
            </td>
            <td><?php echo $fechaCierre; ?></td>
            <td><?php echo $mostrar['area']; ?></td>
            <td>
                    <button class="btn btn-info btn-sm" 
                        onclick="obtenerDatosSolucion(<?php echo $mostrar['idReporte']; ?>)"
                        data-toggle="modal" data-target="#modalAgregarSolucionReporte">
                        Solución
                    </button>
                    <?php echo $mostrar['solucion']; ?>
                </td>
                <td>
                    <?php 
                        if ($mostrar['solucion'] == "") {                      
                    ?>
                    
                    <button class="btn btn-danger btn-sm" 
                        onclick="eliminarReporteAdmin(<?php echo $mostrar['idReporte']; ?>)">
                        Eliminar
                    </button>
                    <?php 
                        }
                    ?>
                </td>
                <td>
                    <a class="btn btn-outline-danger far fa-file-pdf" href="generarpdf.php?idUsuario=<?php echo $mostrar['idUsuario']; ?>"> PDF </a>
                </td>
                <td>
                <div class="chat-container">
                    <button class="btn btn-info btn-sm btn-chat" data-idreporte="<?php echo $mostrar['idReporte']; ?>">
                            Chat
                        </button>
                    <div class="chat-frame" data-chatloaded="false"></div>
                </div>
            </td>
            </tr>
            <?php } ?>
        </tbody>
</table>


<!-- ... Contenedor para el chat ... -->
<div id="chatContainer" style="display: none;">
    <iframe id="chatFrame" src="" style="width: 100%; height: 200px;"></iframe>
</div>  
<script src="reportesAdmin/chat/chat.js"></script>                 
<script>
        $(document).ready(function(){
            $('#tablaReportesAdminDataTable').DataTable(); // Inicializa la tabla de usuarios con DataTable

        });
</script>

