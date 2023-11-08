<?php
    include "header.php";

    // Verifica si hay una sesión activa y si el rol del usuario es igual a 1 o 2
    if (isset($_SESSION['usuario']) && ($_SESSION['usuario']['rol'] == 1 || $_SESSION['usuario']['rol'] == 2)) { 

        $idUsuario = $_SESSION['usuario']['id'];
?>

   
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="fw-light">BIENVENIDO <?php echo $_SESSION['usuario']['nombre'];?></h1>
                <p class="lead">
                    <div class="row">
                        <div class="col-sm-4">
                            <a class="nav-link" href="../../afinzamiento/vistas/inicio.php" >
                                <span></span>AREA AFINZAMIENTO
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="nav-link" href="../../analisis/vistas/inicio.php" >
                                <span></span>AREA ANALISIS
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="nav-link" href="../../cartera/vistas/inicio.php" >
                                <span></span>AREA CARTERA
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="nav-link" href="../../comercial/vistas/inicio.php" >
                                <span></span>AREA COMERCIAL
                            </a>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-4">
                            <a class="nav-link" href="../../contabilidad/vistas/inicio.php" >
                                <span></span>AREA CONTABILIDAD
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="nav-link" href="../../desarrollo/vistas/inicio.php" >
                                <span></span>AREA DESARROLLO
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="nav-link" href="../../gestion_humana/vistas/inicio.php" >
                                <span></span>AREA GESTION HUMANA
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a class="nav-link" href="../../juridico/vistas/inicio.php" >
                                <span></span>AREA JURIDICO
                            </a>
                        </div>
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
