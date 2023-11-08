<?php
    include "header.php";

    // Verifica si hay una sesión activa y si el rol del usuario es igual a 1
    if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] == 1) { 
        include "../clases/conexion.php";
        $con = new Conexion();
        $conexion = $con->conectar();
?>

   
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="fw-light">Reportes de cliente</h1>
                <p class="lead">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearReporte">
                        Crear Reporte
                    </button>
                    <hr>
                    <div id="tablaReporteClienteLoad"></div>
                </p>
            </div>    
        </div>
    </div>

    <?php
    // Incluye el archivo modalCrearReporte.php para los reportes de cliente
    include "reportesCliente/modalCrearReporte.php";
    include "footer.php";
    ?>
    <script src="../public/js/reportesCliente/reportes.js"></script>
    <?php
            
    } else {
        header("location:../index.html");
    }
?> 
