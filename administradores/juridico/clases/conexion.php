<?php 
    // Clase de conexión a la base de datos
    class Conexion {
        // Método para establecer la conexión
        public function conectar() {
            $servidor = "127.0.0.1"; // Dirección del servidor de la base de datos
            $usuario = "root"; // Nombre de usuario de la base de datos
            $password = ""; // Contraseña de la base de datos
            $db = "helpdesk1"; // Nombre de la base de datos
            $conexion = mysqli_connect($servidor, $usuario, $password, $db); // Establecer la conexión utilizando la función mysqli_connect()
            return $conexion; // Devolver el objeto de conexión
        }   
    }
?>
