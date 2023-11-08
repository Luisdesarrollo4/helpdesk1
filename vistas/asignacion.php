<?php
    include "header.php";
    if (isset($_SESSION ['usuario']) && $_SESSION['usuario']['rol'] == 2) { // Comprueba si hay una sesión de usuario activa y si el rol del usuario es 2
        include "../clases/conexion.php"; // Incluye el archivo de conexión a la base de datos
        $con = new Conexion();
        $conexion = $con->conectar(); // Establece la conexión con la base de datos
?>

   
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="fw-light">Asignacion de equipos</h1>
                <p class="lead">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAsignarEquipo">
                        Asignar Equipos</button>
                    <hr>
                    <div id="tablaAsignacionesLoad"></div> <!-- Aquí se mostrará la tabla de asignaciones -->
                </p>
            </div>
        </div>
    </div>

    <?php  
            
            include "asignacion/modalAsignar.php"; // Incluye el archivo modalAsignar.php
            include "footer.php"; // Incluye el archivo footer.php
            ?>
            <script src="../public/js/asignacion/asignacion.js"></script> <!-- Incluye el archivo de script asignacion.js -->
            <?php
            } else {
                header("location:../index.html"); // Redirecciona al usuario a la página de inicio si no cumple las condiciones anteriores
            }
    ?> 
