<?php 
        $datos = array(
            'idPersona' => $_POST['idPersona'],
            'idEquipo' =>   $_POST['idEquipo'],
            'marca' =>  $_POST['marca'] ,
            'modelo' => $_POST['modelo'],
            'serial' => $_POST['serial'],
            'numeroAsignacion' => $_POST['numeroAsignacion'] 
        );

    include "../../clases/Asignacion.php";
    $Asignacion = new Asignacion();

    echo $Asignacion->agregarAsignacion($datos);