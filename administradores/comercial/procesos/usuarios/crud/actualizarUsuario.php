<?php 
    $datos = array(
            'idUsuario'=> $_POST['idUsuario'],
            'tipoDocumento'=> $_POST['tipoDocumentou'],
            'numeroDocumento'=> $_POST['numeroDocumentou'],
            'apellidos'=> $_POST['apellidosu'],
            'nombres'=> $_POST['nombresu'],
            'telefono'=> $_POST['telefonou'],
            'correo'=> $_POST['correou'],
            'oficina'=> $_POST['oficinau'],
            'usuario'=> $_POST['usuariou'],
            'idRol'=> $_POST['idRolu'],
            'area'=> $_POST['areau']
    
    );
     include "../../../clases/Usuarios.php";
     $Usuarios = new Usuarios();
     echo $Usuarios->actualizarUsuario($datos);