    <?php
            // Obtener los datos enviados desde el formulario
            $usuario = $_POST['usuario'];
            $fecha = $_POST['fecha'];
            $descripcion = $_POST['descripcion'];
            $responsable = $_POST['responsable'];

            // Conexión a la base de datos
            $conexion = mysqli_connect("localhost", "root", "", "helpdesk1");

            // Insertar el mantenimiento en la tabla t_mantenimiento
                $consulta = "INSERT INTO t_mantenimiento (id_persona, fecha, descripcion_m, responsable) 
                            VALUES ('$usuario', '$fecha', '$descripcion', '$responsable')";
            $resultado = mysqli_query($conexion, $consulta);

            // Verificar si la consulta se ejecutó correctamente
            if ($resultado) {
                echo "1"; // Envía el código "1" para indicar éxito
            } else {
                echo "Error al guardar el mantenimiento: " . mysqli_error($conexion);
            }

            // Cerrar conexión
            mysqli_close($conexion);
    ?>
