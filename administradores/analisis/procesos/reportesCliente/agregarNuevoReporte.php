<?php 
        session_start();
        $idUsuario = $_SESSION['usuario']['id'];
        $datos = array(
            'problema' => $_POST['problema'],
            'area' => $_POST['area'],
            'idUsuario' => $idUsuario,
            'prioridad' => $_POST['prioridad']
        );


    include "../../clases/Reportes.php";

    $Reportes = new Reportes();

    echo $Reportes->agregarReporteCliente($datos);

