<?php 
    include "conexion.php"; // Incluye el archivo de conexión

    class Inicio extends Conexion{ // Clase Inicio que hereda de la clase Conexion
        public function actualizarPersonales($datos){ // Método para actualizar los datos personales
            $conexion = Conexion::conectar(); // Establece la conexión con la base de datos utilizando el método conectar() de la clase padre Conexion
            $idUsuario = $datos['idUsuario']; // Obtiene el ID de usuario de los datos proporcionados
            $sql = "SELECT id_persona FROM t_usuariosWHERE id_usuario = '$idUsuario'"; // Consulta SQL para obtener el ID de persona asociado al ID de usuario
            $respuesta = mysqli_query($conexion,$sql); // Ejecuta la consulta en la base de datos
            $idPersona = mysqli_fetch_row($respuesta)[0]; // Obtiene el ID de persona de la respuesta y lo almacena en la variable $idPersona
            $sql = "UPDATE
                        t_persona
                    SET
                        tipo_documento = ?,
                        numero_documento = ?,
                        apellidos = ?,
                        nombres = ?,
                        telefono = ?,
                        correo = ?
                    WHERE
                        id_persona = ?"; // Consulta SQL para actualizar los datos personales en la tabla t_persona
            $query = $conexion->prepare($sql); // Prepara la consulta SQL
            $query->bind_param("sssssss",$datos['tipoDocumento'],
                                         $datos['numeroDocumento'],
                                         $datos['apellidos'],
                                         $datos['nombres'],
                                         $datos['telefono'],
                                         $datos['correo'],
                                         $idPersona); // Asigna los valores a los parámetros de la consulta SQL
            $respuesta = $query->execute(); // Ejecuta la consulta SQL
            $query->close(); // Cierra la consulta preparada
            return $respuesta; // Devuelve la respuesta de la ejecución de la consulta
        }
    }
?>
