<?php 
session_start();
include "../../clases/conexion.php";

$con = new Conexion();

if (isset($_SESSION['usuario']) && isset($_SESSION['usuario']['id'])) {
    $idUsuario = $_SESSION['usuario']['id'];

    function obtenerNombreUsuario($idUsuario) {
        // Establece la conexión a la base de datos (deberías incluir tus credenciales aquí)
        $con = new Conexion();
        $conexion = $con->conectar();

        if ($conexion->connect_error) {
            die("La conexión a la base de datos falló: " . $conexion->connect_error);
        }
    
        // Consulta SQL para obtener el nombre del usuario
        $sql = "SELECT CONCAT(persona.apellidos, ' ', persona.nombres) AS nombreCompleto
                FROM t_usuarios AS usuario
                INNER JOIN t_persona AS persona ON usuario.id_persona = persona.id_persona
                WHERE usuario.id_usuario = $idUsuario";
    
        // Ejecutar la consulta SQL
        $resultado = $conexion->query($sql);
    
        if ($resultado) {
            // Obtener el nombre del usuario
            $fila = $resultado->fetch_assoc();
            $nombreUsuario = $fila['nombreCompleto'];
            $resultado->close();
            $conexion->close();
            return $nombreUsuario;
        } else {
            // Manejo de errores en caso de fallo en la consulta
            $conexion->close();
            return "Error al obtener el nombre del usuario";
        }
    }
        
    

// Función para obtener el nombre de un usuario por su ID
        
        // Crear una instancia de la clase de conexión
        $con = new Conexion();
        $conexion = $con->conectar();
        
        // Obtener el ID del usuario almacenado en la sesión
        $idUsuario = $_SESSION['usuario']['id'];
        $contador = 1;
        // Consulta SQL para obtener la lista de usuarios
        $sqlUsuarios = "SELECT usuario.id_usuario, CONCAT(persona.apellidos, ' ', persona.nombres) AS nombreCompleto
            FROM t_usuarios AS usuario
            INNER JOIN t_persona AS persona ON usuario.id_persona = persona.id_persona
            WHERE usuario.area =  6 "; // Cambia "10" por el ID del área específica
            // Obtener la lista de usuarios y convertirla en un arreglo JavaScript

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
                    areas.Nombre AS area,
                    reporte.id_usuario_asignado AS id_usuario_asignado
                FROM
                    t_reportes_general AS reporte
                INNER JOIN t_usuarios AS usuario
                ON
                    reporte.id_usuario = usuario.id_usuario
                INNER JOIN t_persona AS persona
                ON
                    usuario.id_persona = persona.id_persona

                LEFT JOIN areas ON reporte.id_area = areas.ID
                where reporte.id_area = 6
                ORDER BY reporte.fecha_general DESC";




                // Ejecuta la consulta para obtener la lista de usuarios
                $respuestaUsuarios = mysqli_query($conexion, $sqlUsuarios);

             
                
        // Ejecutar la consulta SQL
        $respuesta = mysqli_query($conexion, $sql);
    } else {
        // Manejo de error si la variable de sesión 'usuario' o 'id' no están definidos
        echo "Error: La variable de sesión 'usuario' o 'id' no está definida.";
    }    
    ?>


    <table class="table table-bordered table-sm dt-responsive nowrap" id="tablaReportesAdminDataTable" style="width:100%">
        <thead>
            <th>#</th>
            <th>Persona</th>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Prioridad</th>
            <th>Estatus</th>
            <th>Fecha Cierre</th>
            <th>Area</th>
            <th>Asignar Usuario</th>
            <th>Usuario Asignado</th>
            <th>Solución</th>
            <th>Eliminar</th>
            <th>Bitácoras</th>
            <td>CHAT</td>


            <?php $conexion = $con->conectar(); ?>
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
                <select class="form-control" name="usuario_asignado" id="select_<?php echo $mostrar['idReporte']; ?>" onchange="asignarUsuario(this.value, '<?php echo $mostrar['idReporte'];?>')">
                    <option value="">Seleccionar Usuario</option>
                    <?php
                    // Llena el select con los usuarios obtenidos de la consulta
                    mysqli_data_seek($respuestaUsuarios, 0); // Reiniciar el puntero de resultados
                    while ($usuario = mysqli_fetch_array($respuestaUsuarios)) {
                        $selected = ($usuario['id_usuario'] == $mostrar['id_usuario_asignado']) ? 'selected' : '';
                        echo '<option value="' . $usuario['id_usuario'] . '" ' . $selected . '>' . $usuario['nombreCompleto'] . '</option>';
                    }
                    ?>
                </select>
                <td>
                    <span id="usuario_asignado_<?php echo $mostrar['idReporte']; ?>">
                        <?php
                        $idUsuarioAsignado = $mostrar['id_usuario_asignado'];
                        if ($idUsuarioAsignado !== null) {
                            echo obtenerNombreUsuario($idUsuarioAsignado);
                        } else {
                            echo "No asignado";
                        }
                        ?>
                    </span>
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
                    $('#tablaReportesAdminDataTable').DataTable(); // Inicializa la tabla de usuarios con DataTable

                });
        </script>
