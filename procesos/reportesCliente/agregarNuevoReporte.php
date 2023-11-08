<?php 
        session_start();
        $idUsuario = $_SESSION['usuario']['id'];
        $datos = array(

            'idEquipo' => $_POST['idEquipo'],
            'area' => $_POST['area'],
            'problema' => $_POST['problema'],
            'idUsuario' => $idUsuario,
            'prioridad' => $_POST['prioridad']
            
        );


    include "../../clases/Reportes.php";

    $Reportes = new Reportes();

    echo $Reportes->agregarReporteCliente($datos);

