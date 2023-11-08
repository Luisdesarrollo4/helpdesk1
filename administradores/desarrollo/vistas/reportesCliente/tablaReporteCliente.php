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
                reporte.id_reporte_general AS idReporte,
                reporte.id_usuario AS idUsuario,
                CONCAT(persona.apellidos, ' ', persona.nombres) AS nombrePersona,
                reporte.descripcion_general AS problema,
                reporte.estatus_general AS estatus,
                reporte.solucion_general AS solucion,
                reporte.fecha_cierre AS fecha_cierre,
                reporte.fecha_general AS fecha,
                reporte.prioridad_general AS prioridad,
                areas.Nombre AS area
            FROM
                        t_reportes_general AS reporte
            INNER JOIN t_usuarios AS usuario ON reporte.id_usuario = usuario.id_usuario
            INNER JOIN t_persona AS persona ON usuario.id_persona = persona.id_persona
            LEFT JOIN areas ON reporte.id_area = areas.ID
            WHERE reporte.id_area = 6 OR reporte.id_area_envio = 6";

    
    // Ejecuta la consulta SQL
    $respuesta = mysqli_query($conexion, $sql);
?>

<!-- Se crea una tabla para mostrar los reportes -->
<table class="table table-bordered table-sm dt-responsive nowrap" id="tablaReportesDataTable" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Persona</th>
            <th>Fecha</th>
            <th>Descripcion</th>
            <th>Prioridad</th>
            <th>Estatus</th>
            <th>Fecha Cierre</th>
            <th>Solucion</th>
            <th>Area</th>
            <th>Eliminar</th>
            <th>Bitacora</th>
            <th>chat</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
        <tr>
            <td><?php echo $contador++; ?></td>
            <td><?php echo $mostrar['nombrePersona']; ?></td>
            <td><?php echo $mostrar['fecha']; ?></td>
            <td><?php echo $mostrar['problema']; ?></td>
            <td><?php echo $mostrar['prioridad'];?></td>
            <td>
                    <?php  
                    // Verifica el estatus del reporte y muestra un badge con el estado correspondiente
                    $fechaCierre = $mostrar['fecha_cierre'];
                    $estatus = $mostrar['estatus'];
                    $cadenaEstatus = '<span class="badge badge-danger">Abierto</span>';
                    if ($estatus == 1) {
                        $cadenaEstatus = '<span class="badge badge-success">Cerrado</span>';
                    } elseif ($fechaCierre && time() > strtotime($fechaCierre)) {
                        $this->actualizarSolucionCliente(array(
                            'idReporte' => $mostrar['idReporte'],
                            'solucion' => 'Cerrado automáticamente por el sistema debido a la prioridad y la fecha de cierre.',
                            'estatus' => 1
                        ));
                        $cadenaEstatus = '<span class="badge badge-success">Cerrado</span>';}
                    echo $cadenaEstatus;
                    ?>
                </td>
            <td><?php echo $fechaCierre; ?></td>
           <td>
            <!-- <button class="btn btn-info btn-sm"
                    onclick="obtenerDatosSolucionCliente('<?php echo $mostrar['idReporte'];?>')"
                    data-toggle="modal" data-target="#modalCambiarEstatus">
                    Solución
            </button> -->
                    <?php echo $mostrar['solucion'] ?>
            </td>
            <td><?php echo $mostrar['area']; ?></td>
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
            <a class="btn btn-outline-danger far fa-file-pdf" href="generarpdf.php?idUsuario=<?php echo $mostrar['idUsuario']; ?>"> PDF </a>


                </td>
            <td>
                    <a class="btn btn-success" href="chat/index.php?id=<?php echo $idUsuario ?>">Hola
                    </a>
                </td>

        </tr>
        <?php } ?>
    </tbody>
</table>
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
