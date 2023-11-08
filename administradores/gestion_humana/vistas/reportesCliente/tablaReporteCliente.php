<?php 
    // Inicia la sesión
    session_start();
    
    // Incluye el archivo de conexión a la base de datos
    include "../../clases/conexion.php";
    
    // Crea una instancia de la clase Conexion y establece la conexión con la base de datos
    $con = new Conexion();
    $conexion = $con->conectar();
    
    // Obtiene el ID del usuario almacenado en la sesión
    $idUsuario = $_SESSION['usuario']['id'];
    
    // Variable para llevar el contador de filas
    $contador = 1;
    
    // Consulta SQL para obtener los reportes del usuario específico
    $sql = "SELECT
                reporte.id_reporte AS idReporte,
                reporte.id_usuario AS idUsuario,
                CONCAT(persona.apellidos, ' ', persona.nombres) AS nombrePersona,
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
            INNER JOIN t_usuarios_humana AS usuario ON reporte.id_usuario = usuario.id_usuario_ges
            INNER JOIN t_persona AS persona ON usuario.id_persona = persona.id_persona
            INNER JOIN t_cat_equipo AS equipo ON reporte.id_equipo = equipo.id_equipo
            INNER JOIN t_asignacion AS asignacion ON reporte.id_equipo = asignacion.id_equipo
            WHERE
                reporte.id_usuario = '$idUsuario'";
    
    // Ejecuta la consulta SQL
    $respuesta = mysqli_query($conexion, $sql);
?>

<!-- Se crea una tabla para mostrar los reportes -->
<table class="table table-bordered table-sm dt-responsive nowrap" id="tablaReportesDataTable" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Persona</th>
            <th>Dispositivo</th>
            <th>Numero Asignacion</th>
            <th>Fecha</th>
            <th>Descripcion</th>
            <th>Prioridad</th>
            <th>Estatus</th>
            <th>Solucion</th>
            <th>Eliminar</th>
            <th>Bitacora</th>
        </tr>
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
                // Verifica el estatus del reporte y muestra un badge con el estado correspondiente
                $estatus = $mostrar['estatus'];
                $cadenaEstatus = '<span class="badge badge-danger">Abierto</span>';
                if ($estatus == 1) {
                    $cadenaEstatus = '<span class="badge badge-success">Cerrado</span>';
                }
                echo $cadenaEstatus;
                ?>
            </td>
            <td><?php echo $mostrar['solucion']; ?></td>
            <td>
                <?php 
                // Si el reporte no tiene solución, muestra un botón de eliminar
                if ($mostrar['solucion'] == ""){                      
                ?>
                <button class="btn btn-danger btn-sm" onclick="eliminarReporteCliente(<?php echo $mostrar['idReporte']?>)">
                    Eliminar
                </button>
                <?php }?>
            </td>
            <td>
                <button class="btn btn-outline-danger far fa-file-pdf"> PDF </button>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Se agrega un elemento de chat y un script para interactuar con un sistema de llamadas -->
<td>    
    <call-us-selector phonesystem-url="https://1341.3cx.cloud" party="LiveChat632306"></call-us-selector>
    <script defer src="https://downloads-global.3cx.com/downloads/livechatandtalk/v1/callus.js" id="tcx-callus-js" charset="utf-8"></script>
</td>

<script>
    $(document).ready(function(){
        // Inicialización de DataTables y configuración de los botones de exportación
        $('#tablaReportesDataTable').DataTable({
            dom: 'Bfrtip',
            buttons : {
                buttons : [
                    {
                        extend : 'copy',
                        className : 'btn btn-outline-info',
                        text : '<i class="far fa-copy"></i> COPIAR'
                    },
                    {
                        extend : 'csv',
                        className : 'btn btn-outline-primary',
                        text : '<i class="fas fa-file-csv"></i> CSV'
                    },
                    {
                        extend : 'excel',
                        className : 'btn btn-outline-success',
                        text : '<i class="far fa-file-excel"></i> EXCEL'
                    },
                    {
                        extend : 'pdf',
                        className : 'btn btn-outline-danger',
                        text : '<i class="far fa-file-pdf"></i> PDF'
                    },
                ],
                dom : {
                    button : {
                        className : 'btn'
                    }
                }
            }
        });
    })
</script>
