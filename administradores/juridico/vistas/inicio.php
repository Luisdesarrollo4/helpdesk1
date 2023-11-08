<?php
    include "header.php";

    // Verifica si hay una sesión activa y si el rol del usuario es igual a 1 o 2
    if (isset($_SESSION['usuario']) && ($_SESSION['usuario']['rol'] == 1 || $_SESSION['usuario']['rol'] == 2)) { 

        $idUsuario = $_SESSION['usuario']['id'];
?>

   
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1>AREA JURIDICO</h1>
                <h1 class="fw-light">BIENVENIDO <?php echo $_SESSION['usuario']['nombre'];?></h1>
                <p class="lead">
                    <div class="row">
                        <div class="col-sm-4">Tipo de documento: <span id="tipo_documento"></span></div>
                        <div class="col-sm-4">Numero de documento: <span id="numero_documento"></span></div>
                        <div class="col-sm-4">Apellidos: <span id="apellidosa"></span></div>
                        <div class="col-sm-4">Nombres: <span id="nombresa"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Telefono: <span id="telefono"></span></div>
                        <div class="col-sm-4">Correo: <span id="correo"></span></div>
                        <div class="col-sm-4">oficina: <span id="oficina"></span></div>
                    </div>
                </p>
            </div>  
        </div>
    </div>

    <?php  
    include "footer.php";
    ?>
    <script src="../public/js/inicio/personales.js"></script>
    <script>
        let idUsuario = '<?php echo $idUsuario; ?>';
        datosPersonalesInicio(idUsuario);
    </script>
    <?php
    } else {
        header("location:../index.html");
    }
?> 
