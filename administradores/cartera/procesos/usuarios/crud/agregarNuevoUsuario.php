<?php 
    $datos = array (
       "tipo_documento" =>$_POST['tipo_documento'],
       "numero_documento" =>$_POST['numero_documento'],
       "apellidos" =>$_POST['apellidos'],
       "nombres" =>$_POST['nombres'],
       "oficina" =>$_POST['oficina'],
       "telefono" =>$_POST['telefono'], 
       "correo" =>$_POST['correo'],
       "usuario" =>$_POST['usuario'], 
       "password" =>sha1($_POST['password']),
       "idRol" =>$_POST['idRol'],
       "area" =>$_POST['area']
    
    );

    include "../../../clases/Usuarios.php";
    $Usuarios = new Usuarios();

    echo $Usuarios->agregaNuevoUsuario($datos);

