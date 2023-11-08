<?php
    include "conexion.php";

    // Clase Asignacion que extiende de la clase Conexion
    class Asignacion extends Conexion{
        // Método para agregar una asignación
        public function agregarAsignacion($datos){
            $conexion = Conexion::conectar(); // Conexión a la base de datos

            // Consulta SQL para insertar los datos de la asignación
            $sql = "INSERT INTO t_asignacion (id_persona,
                                 id_equipo,
                                 marca,
                                 modelo,                                 
                                 numero_asignacion,
                                 serial)
                    VALUES (?, ?, ?, ?, ?, ?)";

            $query = $conexion->prepare($sql); // Preparar la consulta
            // Asignar los valores de los parámetros utilizando bind_param
            $query->bind_param('iissss',  $datos['idPersona'],
                                             $datos['idEquipo'],
                                             $datos['marca'],
                                             $datos['modelo'],
                                             $datos['numeroAsignacion'],
                                             $datos['serial']);
            $respuesta = $query->execute(); // Ejecutar la consulta
            $query->close(); // Cerrar la consulta
            return $respuesta; // Devolver la respuesta de la ejecución
        }

        // Método para eliminar una asignación
        public function eliminarAsigancion($idAsignacion){
            $conexion = Conexion::conectar(); // Conexión a la base de datos
            // Consulta SQL para eliminar la asignación con el ID proporcionado
            $sql = "DELETE FROM t_asignacion where id_asignacion = ?";
            $query = $conexion->prepare($sql); // Preparar la consulta
            $query->bind_param('i', $idAsignacion); // Asignar el valor del parámetro
            $respuesta = $query->execute(); // Ejecutar la consulta
            $query->close(); // Cerrar la consulta
            return $respuesta; // Devolver la respuesta de la ejecución
        }
    }
?>
