    <?php
            require '../fpdf/fpdf.php';

            // Definir los datos de conexión
            $servername = "localhost";  // Cambiar a la dirección de tu servidor de base de datos si es necesario
            $username = "root";  // Cambiar al nombre de usuario de tu base de datos
            $password = "root";  // Cambiar a la contraseña de tu base de datos
            $dbname = "helpdesk1";  // Cambiar al nombre de tu base de datos

            // Crear la conexión
            $conexion = new mysqli($servername, $username, $password, $dbname);

            // Verificar si se produjo un error en la conexión
            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            class PDF extends FPDF
            {
                // Cabecera de página
                function Header()
                {   
                    // Obtener el ID de la persona desde la URL
                    $idPersona = $_GET['idUsuario'];
                    
                    global $conexion;
                    
                    // Obtener los datos de la persona desde la base de datos
                    $sql = "SELECT * FROM t_persona WHERE id_persona = $idPersona";
                    $resultado = mysqli_query($conexion, $sql);
                    $dato_info = mysqli_fetch_object($resultado);
                    
                    // Logo
                    $this->Image('../fpdf/tutorial/fondo.png', 5, 8, 15, 0);
                    
                    // Título
                    $this->SetFont('Arial','B',15);
                    $this->Cell(45);
                    $this->Cell(110,15,'FIANZAS DE COLOMBIA S.A',0,1,'C',0);
                    
                    // Tipo de documento
                    $this->SetFont("Arial", 'B', 10);
                    $this->SetTextColor(0, 180, 0); // Color rojo
                    $this->Cell(35, 10, utf8_decode("Tipo de documento:"), 0, 0, 'L');
                    $this->SetTextColor(0, 0, 0);//color negro
                    $this->SetFont("Arial", '', 10);
                    $tipoDocumento = trim(utf8_decode($dato_info->tipo_documento));
                    $this->Cell(60, 10, $tipoDocumento, 0, 1, 'L');
                    
                    // Número de documento
                    $this->SetFont("Arial", 'B', 10);
                    $this->SetTextColor(0, 180, 0); // Color rojo
                    $this->Cell(35, 10, utf8_decode("Número Documento:"), 0, 0, 'L');
                    $this->SetTextColor(0, 0, 0);//color negro
                    $this->SetFont("Arial", '', 10);
                    $numeroDocumento = trim(utf8_decode($dato_info->numero_documento));
                    $this->Cell(60, 10, $numeroDocumento, 0, 1, 'L');
            
                    // Nombres
                    $this->SetFont("Arial", 'B', 10);
                    $this->SetTextColor(0, 180, 0); // Color rojo
                    $this->Cell(20, 10, utf8_decode("Nombres:"), 0, 0, 'L');
                    $this->SetTextColor(0, 0, 0);//color negro
                    $this->SetFont("Arial", '', 10);
                    $nombres = trim(utf8_decode($dato_info->nombres));
                    $this->Cell(60, 10, $nombres, 0, 0, 'L');
            
                    // Apellidos
                    $this->SetFont("Arial", 'B', 10);
                    $this->SetTextColor(0, 180, 0); // Color rojo
                    $this->Cell(20, 10, utf8_decode("Apellidos:"), 0, 0, 'L');
                    $this->SetTextColor(0, 0, 0);//color negro
                    $this->SetFont("Arial", '', 10);
                    $apellidos = trim(utf8_decode($dato_info->apellidos));
                    $this->Cell(60, 10, $apellidos, 0, 1, 'L');
            
                    // Teléfono
                    $this->SetFont("Arial", 'B', 10);
                    $this->SetTextColor(0, 180, 0); // Color rojo
                    $this->Cell(20, 10, utf8_decode("Teléfono:"), 0, 0, 'L');
                    $this->SetTextColor(0, 0, 0);//color negro
                    $this->SetFont("Arial", '', 10);
                    $telefono = trim(utf8_decode($dato_info->telefono));
                    $this->Cell(60, 10, $telefono, 0, 0, 'L');
            
                    // Correo
                    $this->SetFont("Arial", 'B', 10);
                    $this->SetTextColor(0, 180, 0); // Color rojo
                    $this->Cell(15, 10, utf8_decode("Correo:"), 0, 0, 'L');
                    $this->SetTextColor(0, 0, 0);//color negro
                    $this->SetFont("Arial", '', 10);
                    $correo = trim(utf8_decode($dato_info->correo));
                    $this->Cell(60, 10, $correo, 0, 1, 'L');
            
                    $this->Ln(10);
        }
        
        // Pie de página
        function Footer()
        {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
        
            // Número de página
            $this->SetFont('Arial','I',8);
            $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
        
            // Guardar la posición actual
            $position = $this->GetY();
        
            // Agregar firma del técnico
            $this->SetY($position - 20); // Subir 2 cm
            $this->SetFont('Arial','I',8);
            $this->Cell(0, 10, utf8_decode('Firma del Técnico'), 0, 0, 'L');
        
            // Agregar firma del usuario
            $this->SetY($position - 20); // Subir 2 cm
            $this->SetFont('Arial','I',8);
            $this->Cell(0, 10, utf8_decode('Firma del Usuario'), 0, 0, 'R');
        
            // Restaurar la posición original y agregar la fecha actual
            $this->SetY($position);
            $this->Cell(355, 10, utf8_decode(date('d/m/y')), 0, 0, 'C');
        }
        
    }

                // Obtener el ID del usuario desde la URL
                $idUsuario = $_GET['idUsuario'];


                // Consulta SQL para obtener los datos del usuario y otros campos necesarios
                $sql = "SELECT
                        CONCAT(persona.apellidos, ' ', persona.nombres) AS nombrePersona,
                        reporte.fecha_general AS fecha,
                        reporte.fecha_cierre AS fechaCierre,
                        reporte.descripcion_general AS problema,
                        reporte.estatus_general AS estatus,
                        reporte.solucion_general AS solucion,
                        areas.Nombre AS nombreArea
                    FROM
                        t_reportes_general AS reporte
                    INNER JOIN t_usuarios AS usuario ON reporte.id_usuario = usuario.id_usuario
                    INNER JOIN t_persona AS persona ON usuario.id_persona = persona.id_persona
                    INNER JOIN areas ON reporte.id_area = areas.ID
                    WHERE
                        usuario.id_usuario = $idUsuario";

    // Ejecutar la consulta
            $resultado = mysqli_query($conexion, $sql);

            // Verificar si se encontraron resultados
            if ($resultado && mysqli_num_rows($resultado) > 0) {
                // Crear el objeto PDF
                $pdf = new PDF();
                $pdf->AddPage();
                $pdf->AliasNbPages();
            
                // Obtener los datos del usuario
                $datosUsuario = mysqli_fetch_assoc($resultado);
                
                // Mostrar los datos en el PDF
                $pdf->SetFont('Arial', '', 12);

                $pdf->Cell(0, 10, 'Fecha: ' . $datosUsuario['fecha'], 0, 1);

                $pdf->Cell(0, 10, 'Fecha de Cierre: ' . $datosUsuario['fechaCierre'], 0, 1);
                
                $pdf->Cell(0, 10, utf8_decode('Descripción: ' . $datosUsuario['problema']), 0, 1);

                $pdf->Cell(0, 10, 'Area: ' . $datosUsuario['nombreArea'], 0, 1); // Agregar el nombre del área
                
                // Mostrar el estado
                $estado = $datosUsuario['estatus'];
                if ($estado == 1) {
                    $estadoLabel = 'Cerrado';
                } elseif ($estado == 0) {
                    $estadoLabel = 'Abierto';
                } else {
                    $estadoLabel = 'Desconocido';
                }
                $pdf->Cell(0, 10, 'Estatus: ' . $estadoLabel, 0, 1);
                
                $pdf->Cell(0, 10 ,utf8_decode( 'Solución: ' . $datosUsuario['solucion']), 0, 1);
                $pdf->Output('prueba.pdf', 'I');
            } else {
                echo "No se encontraron resultados para el ID de usuario proporcionado.";
            }
            
            // Cerrar la conexión a la base de datos
            $conexion->close();
            ?>