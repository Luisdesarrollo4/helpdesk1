<?php 
        session_start();
        $idUsuario = $_SESSION['usuario']['id'];
        $datos = array(
            
            'problema' => $_POST['problema'],
            'idUsuario' => $idUsuario,
            'area' => $_POST['area'],
            'prioridad' => $_POST['prioridad']
        );


    include "../../clases/Reportes.php";

    $Reportes = new Reportes();

    echo $Reportes->agregarReporteCliente($datos);

