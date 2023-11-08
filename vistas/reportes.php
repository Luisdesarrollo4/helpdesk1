<?php
    include "header.php";

    // Verifica si hay una sesión activa y si el rol del usuario es igual a 2
    if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] == 2) { 
?>

<div class="container">
    <div class="card border-0 shadow my-5">
        <div class="card-body p-5">
            <h1 class="fw-light">Reportes</h1>
            <p class="lead">
                <hr>
                <div id="tablaReporteAdminLoad"></div>
            </p>
        </div>
    </div>
</div>

<?php
    // Incluye el archivo modalAgregarSolucion.php para los reportes administrativos

    include "reportesAdmin/modalAgregarSolucion.php";
    
    include "footer.php";
?>
<script src="../public/js/reportesAdmin/reportesAdmin.js"></script>

<?php
    } else {
        header("location:../index.html");
    }
?> 
    