
<?php 
    include "conexion.php";
    class Usuarios extends Conexion {
        
        // Método para realizar el inicio de sesión de un usuario
        public function loginUsuario($usuario, $password) {
            $conexion = Conexion::conectar();
            $sql = "SELECT * FROM t_usuarios
                    WHERE usuario = '$usuario' AND password = '$password'";
            $respuesta = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($respuesta) > 0) {
                $datosUsuarios = mysqli_fetch_array($respuesta);

                if ($datosUsuarios['activo'] == 1) {
                    // Almacenar los datos del usuario en la sesión
                    $_SESSION['usuario']['nombre'] = $datosUsuarios['usuario'];
                    $_SESSION['usuario']['id'] = $datosUsuarios['id_usuario'];
                    $_SESSION['usuario']['rol'] = $datosUsuarios['id_rol'];
                    return 1; // Inicio de sesión exitoso
                } else {
                    return 0; // Usuario inactivo
                }
            } else {
                return 0; // Usuario y contraseña no coinciden
            }
        }
        
        // Método para agregar un nuevo usuario
        public function agregaNuevoUsuario($datos) {
            $conexion = Conexion::conectar();
            $idPersona = self::agregarPersona($datos);

            if ($idPersona > 0) {
                $sql = "INSERT INTO t_usuarios (id_rol, id_persona, usuario, password)
                        VALUES (?, ?, ?, ?)";
                $query = $conexion->prepare($sql);
                $query->bind_param("iiss", $datos['idRol'], $idPersona, $datos['usuario'], $datos['password']);

                $respuesta = $query->execute();
                return $respuesta;
            } else {
                return 0; // Error al agregar la persona
            }
        }

        // Método para agregar una nueva persona
        public function agregarPersona($datos) {
            $conexion = Conexion::conectar();
            $sql = "INSERT INTO t_persona (tipo_documento, numero_documento, apellidos, nombres, telefono, correo, oficina)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $query = $conexion->prepare($sql);
            $query->bind_param("sssssss", $datos['tipo_documento'], $datos['numero_documento'], $datos['apellidos'],
                $datos['nombres'], $datos['telefono'], $datos['correo'], $datos['oficina']);

            $respuesta = $query->execute();
            $idPersona = mysqli_insert_id($conexion);
            $query->close();
            return $idPersona;
        }

        // Método para obtener los datos de un usuario
        public function obtenerDatosUsuario($idUsuario) {
            $conexion = Conexion::conectar();
            $sql = "SELECT usuarios.id_usuario AS idUsuario, usuarios.usuario AS nombreUsuario,
                    roles.nombre AS rol, usuarios.id_rol AS idRol,
                    usuarios.activo AS estatus, usuarios.id_persona AS idPersona,
                    persona.oficina AS oficina, persona.tipo_documento AS tipoDocumento,
                    persona.numero_documento AS numeroDocumento, persona.apellidos AS apellidos,
                    persona.nombres AS nombres, persona.correo AS correo, persona.telefono AS telefono
                    FROM t_usuarios AS usuarios
                    INNER JOIN t_cat_roles AS roles ON usuarios.id_rol = roles.id_rol
                    INNER JOIN t_persona AS persona ON usuarios.id_persona = persona.id_persona
                    AND usuarios.id_usuario = '$idUsuario'";
            $respuesta = mysqli_query($conexion, $sql);
            $usuario = mysqli_fetch_array($respuesta);

            $datos = array(
                'idUsuario' => $usuario['idUsuario'],
                'nombreUsuario' => $usuario['nombreUsuario'],
                'rol' => $usuario['rol'],
                'idRol' => $usuario['idRol'],
                'estatus' => $usuario['estatus'],
                'idPersona' => $usuario['idPersona'],
                'oficina' => $usuario['oficina'],
                'tipoDocumento' => $usuario['tipoDocumento'],
                'numeroDocumento' => $usuario['numeroDocumento'],
                'apellidos' => $usuario['apellidos'],
                'nombres' => $usuario['nombres'],
                'correo' => $usuario['correo'],
                'telefono' => $usuario['telefono']
            );
            return $datos;
        }

        // Método para actualizar los datos de un usuario
        public function actualizarUsuario($datos) {
            $conexion = Conexion::conectar();
            $exitoPersona = self::actualizarPersona($datos);

            if ($exitoPersona) {    
                $sql = "UPDATE t_usuarios SET id_rol = ?, usuario = ?
                        WHERE id_usuario = ?";   
                $query = $conexion->prepare($sql);
                $query->bind_param('iss', $datos['idRol'], $datos['usuario'], $datos['idUsuario']); 
                $respuesta = $query->execute();
                $query->close();
                return $respuesta;
            } else {
                return 0; // Error al actualizar la persona
            }
        }

        // Método para actualizar los datos de una persona
        public function actualizarPersona($datos) {
            $conexion = Conexion::conectar();
            $idPersona = self::obtenerIdPersona($datos['idUsuario']);

            $sql = "UPDATE t_persona SET tipo_documento = ?, numero_documento = ?, apellidos = ?, nombres = ?,
                    telefono = ?, correo = ?, oficina = ? WHERE id_persona = ?";
            $query = $conexion->prepare($sql);
            $query->bind_param('sssssssi', $datos['tipoDocumento'], $datos['numeroDocumento'], $datos['apellidos'],
                $datos['nombres'], $datos['telefono'], $datos['correo'], $datos['oficina'], $idPersona);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }

        // Método para obtener el ID de la persona asociada a un usuario
        public function obtenerIdPersona($idUsuario) {
            $conexion = Conexion::conectar();
            $sql = "SELECT persona.id_persona AS idPersona FROM t_usuarios AS usuarios
                    INNER JOIN t_persona AS persona ON usuarios.id_persona = persona.id_persona
                    AND usuarios.id_usuario = '$idUsuario'";
            $respuesta = mysqli_query($conexion, $sql);
            $idPersona = mysqli_fetch_array($respuesta)['idPersona'];
            return $idPersona;
        }

        // Método para restablecer la contraseña de un usuario
        public function resetPassword($datos) {
            $conexion = Conexion::conectar();
            $sql = "UPDATE t_usuarios SET password = ? WHERE id_usuario = ?";
            $query = $conexion->prepare($sql);
            $query->bind_param('si', $datos['password'], $datos['idUsuario']);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }

        // Método para cambiar el estatus de un usuario (activo o inactivo)
        public function cambioEstatusUsuario($idUsuario, $estatus) {
            $conexion = Conexion::conectar();

            if ($estatus == 1) {
                $estatus = 0;
            } else {
                $estatus = 1;
            }

            $sql = "UPDATE t_usuarios SET activo = ? WHERE id_usuario = ?";
            $query = $conexion->prepare($sql);
            $query->bind_param('ii', $estatus, $idUsuario);
            $respuesta = $query->execute();
            $query->close();
            return $respuesta;
        }

        // Método para buscar reportes asociados a un usuario
        public function buscarReportesUsuario($idUsuario) {
            $conexion = Conexion::conectar();

            $sql = "SELECT * FROM t_reportes_general WHERE id_usuario = '$idUsuario'";
            $respuesta = mysqli_query($conexion, $sql);

            if (mysqli_num_rows($respuesta) > 0) {
                return 1;
            } else {
                return 0;
            }
        }

        // Método para buscar asignaciones asociadas a una persona

        // Método para eliminar un usuario
        public function eliminarUsuario($datos) {
            $conexion = Conexion::conectar();
            $reportes = self::buscarReportesUsuario($datos['idUsuario']);
            $asignaciones = self::buscarAsignacionPersona($datos['idPersona']);

            if ($reportes == 0 && $asignaciones == 0) {
                $sql = "DELETE FROM t_usuarios WHERE id_usuario = ?";
                $query = $conexion->prepare($sql);
                $query->bind_param('i', $datos['idUsuario']);
                $respuesta = $query->execute();
                $query->close();
                return $respuesta;
            } else {
                return 0; // No se puede eliminar el usuario
            }
        }
    }
?>
