<?php
    include "conexion.php"; // Incluye el archivo de conexión

    class Reportes extends Conexion // Clase Reportes que hereda de la clase Conexion
    {
        public function agregarReporteCliente($datos){
            $conexion = Conexion::conectar(); // Establece la conexión con la base de datos utilizando el método conectar() de la clase padre Conexion
            $sql = "INSERT INTO t_reportes (id_usuario,
                                            id_equipo,
                                            descripcion_problema,
                                            prioridad)
                    VALUES (?, ?, ?, ?)"; // Consulta SQL para agregar un nuevo reporte de cliente en la tabla t_reportes
            $query = $conexion->prepare($sql); // Prepara la consulta SQL
            $query->bind_param('iiss', $datos['idUsuario'],
                                      $datos['idEquipo'],
                                      $datos['problema'],
                                      $datos['prioridad']); // Asigna los valores a los parámetros de la consulta SQL
            $respuesta = $query->execute(); // Ejecuta la consulta SQL
            $query->close(); // Cierra la consulta preparada
            return $respuesta; // Devuelve la respuesta de la ejecución de la consulta
        }
        
        public function eliminarReporteCliente($idReporte){
            $conexion = Conexion::conectar(); // Establece la conexión con la base de datos utilizando el método conectar() de la clase padre Conexion
            $sql = "DELETE FROM t_reportes WHERE id_reporte = ?"; // Consulta SQL para eliminar un reporte de cliente de la tabla t_reportes
            $query = $conexion->prepare($sql); // Prepara la consulta SQL
            $query->bind_param('i', $idReporte); // Asigna el valor al parámetro de la consulta SQL
            $respuesta = $query->execute(); // Ejecuta la consulta SQL
            $query->close(); // Cierra la consulta preparada
            return $respuesta; // Devuelve la respuesta de la ejecución de la consulta
        }
    
        public function obtenerSolucion($idReporte){
            $conexion = Conexion::conectar(); // Establece la conexión con la base de datos utilizando el método conectar() de la clase padre Conexion
            $sql = "SELECT solucion_problema, estatus
                    FROM t_reportes
                    WHERE id_reporte = '$idReporte'"; // Consulta SQL para obtener la solución y el estado de un reporte de la tabla t_reportes
            $respuesta = mysqli_query($conexion, $sql); // Ejecuta la consulta SQL en la base de datos
            $reporte = mysqli_fetch_array($respuesta); // Obtiene los datos del reporte de la respuesta
            
            $datos = array (
                "idReporte" => $idReporte,
                "estatus" => $reporte['estatus'],
                "solucion" => $reporte['solucion_problema']
            ); // Crea un arreglo con los datos del reporte obtenidos
            
            return $datos; // Devuelve el arreglo de datos
        }
        
        public function actualizarSolucion($datos){
            $conexion = Conexion::conectar(); // Establece la conexión con la base de datos utilizando el método conectar() de la clase padre Conexion
            $sql = "UPDATE t_reportes 
                    SET id_usuario_tecnico = ?,
                        solucion_problema = ?,
                        estatus = ?
                    WHERE id_reporte = ?"; // Consulta SQL para actualizar la solución y el estado de un reporte en la tabla t_reportes
            $query  = $conexion->prepare($sql); // Prepara la consulta SQL
            $query->bind_param('isii',  $datos['idUsuario'],
                                        $datos['solucion'],
                                        $datos['estatus'],
                                        $datos['idReporte']); // Asigna los valores a los parámetros de la consulta SQL
            $respuesta = $query->execute(); // Ejecuta la consulta SQL
            $query->close(); // Cierra la consulta preparada
            return $respuesta; // Devuelve la respuesta de la ejecución de la consulta
        }   
    }
?>
