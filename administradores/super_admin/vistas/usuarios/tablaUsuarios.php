    <?php
        include "../../clases/conexion.php"; // Incluye el archivo de conexión a la base de datos
        $con = new conexion();
        $conexion = $con->conectar(); // Establece la conexión con la base de datos
        $sql = "SELECT 
                usuarios.id_usuario AS idUsuario,
                usuarios.usuario AS nombreUsuario,
                roles.nombre AS rol,
                usuarios.id_rol AS idRol,
                area.nombre As area,
                usuarios.activo AS estatus,
                usuarios.id_persona AS idPersona,
                persona.tipo_documento AS tipoDocumento,
                persona.numero_documento AS numeroDocumento,
                persona.apellidos AS apellidos,
                persona.nombres AS nombres,
                persona.oficina AS oficina,
                persona.correo AS correo,
                persona.telefono as telefono
            FROM
                t_usuarios AS usuarios 
                    INNER JOIN 
                t_cat_roles AS roles ON usuarios.id_rol = roles.id_rol 
                    INNER JOIN 
                t_persona AS persona ON usuarios.id_persona = persona.id_persona
                    INNER JOIN
                areas AS area ON usuarios.area = area.ID"; // Consulta SQL para obtener los datos de los usuarios

            $respuesta = mysqli_query($conexion, $sql); // Ejecuta la consulta y guarda el resultado en $respuesta
    ?>

    <table class="table table-sm dt-responsive nowrap" id="tablaUsuariosDataTable" style="width:100%">
        <thead>
            <th>Tipo documento</th>
            <th>Numero de documento</th>
            <th>Apellidos</th>
            <th>Nombres</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Usuario</th>
            <th>Area</th>
            <th>oficina</th>
            <th>Reset Password</th>
            <th>Activar</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </thead>
        <tbody>
            <?php 
                while ($mostrar = mysqli_fetch_array($respuesta)) { // Recorre cada fila de resultados obtenidos
            ?>
            <tr>
                <td><?php echo $mostrar['tipoDocumento']; ?></td>
                <td><?php echo $mostrar['numeroDocumento']; ?></td>
                <td><?php echo $mostrar['apellidos']; ?></td>
                <td><?php echo $mostrar['nombres']; ?></td>
                <td><?php echo $mostrar['telefono']; ?></td>
                <td><?php echo $mostrar['correo']; ?></td>
                <td><?php echo $mostrar['nombreUsuario']; ?></td>
                <td><?php echo $mostrar['area']; ?></td>
                <td><?php echo $mostrar['oficina']; ?></td>
                <td>
                    <button class="btn btn-info btn-sm" 
                            data-toggle="modal" 
                            data-target="#modalResetPassword"
                            onclick="agregarIdUsuarioReset(<?php echo $mostrar ['idUsuario']?>)">
                        Cambiar contraseña
                    </button>
                </td>
                <td>
                    <?php if ($mostrar['estatus'] == 1) { // Comprueba el estado del usuario
                    ?>
                        <button class="btn btn-secondary btn-sm" 
                                onclick="cambiarEstatusUsuario(<?php echo $mostrar['idUsuario']?>,<?php echo $mostrar['estatus']?>)">
                            <span class="fas fa-power-off"></span>Off
                        </button>
                    <?php 
                        } else if($mostrar['estatus'] == 0){
                    ?>
                        <button class="btn btn-success btn-sm" 
                                onclick="cambiarEstatusUsuario(<?php echo $mostrar['idUsuario']?>,<?php echo $mostrar['estatus']?>)">
                            <span class="fas fa-power-off"></span>On
                        </button>
                    <?php
                        } 
                    ?>
                </td>
                <td>
                    <button class="btn btn-warning btn-sm" 
                            data-toggle="modal" 
                            data-target="#modalActualizarUsuarios"
                            onclick="obtenerDatosUsuario(<?php echo $mostrar ['idUsuario'];?>)">
                        Editar
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm" 
                            onclick="eliminarUsuario(<?php echo $mostrar ['idUsuario']; ?>, <?php echo $mostrar ['idPersona']; ?>)">
                        <span class="fas fa-user-times"></span>
                    </button>
                </td>
            </tr>
                
            <?php } ?>
        </tbody>
    </table>
    <td>    
        <call-us-selector phonesystem-url="https://1341.3cx.cloud" party="LiveChat632306"></call-us-selector>
        <script defer src="https://downloads-global.3cx.com/downloads/livechatandtalk/v1/callus.js" id="tcx-callus-js" charset="utf-8"></script>
    </td>

    <?php   
        include 'modalActualizar.php'; // Incluye el archivo modalActualizar.php
    ?>

    <script>
        $(document).ready(function(){
            $('#tablaUsuariosDataTable').DataTable(); // Inicializa la tabla de usuarios con DataTable
        });
    </script>
