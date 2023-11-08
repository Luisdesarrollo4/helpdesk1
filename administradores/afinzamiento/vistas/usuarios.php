<?php
      include "header.php";

      // Verifica si hay una sesión activa y si el rol del usuario es igual a 2
      if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] == 2) { 
?>

   
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="fw-light">Usuarios</h1>
                <p class="lead">
                   <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuarios">
                        Agregar Nuevo Usuario
                   </button>
                   <hr>
                   <div id="tablaUsuarioLoad">
                   </div>
                </p>      
        </div>
    </div>
                
    <?php   
            include 'usuarios/modalResetPassword.php';
            include 'usuarios/modalAgregar.php';

       
    ?>
                
      <?php  
             include "footer.php";
        ?>
        <script src="../public/js/usuarios/usuarios.js"></script>
    <?php
            } else {
                header("location:../index.html");
            }
    ?> 
