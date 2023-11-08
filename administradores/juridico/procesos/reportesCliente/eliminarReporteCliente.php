<?php 
    $idReporte = $_POST['idReporte'];

    include "../../clases/reportes.php";
    $Reportes = new Reportes();
    echo $Reportes->eliminarReporteCliente($idReporte);