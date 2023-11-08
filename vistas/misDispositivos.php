<?php
    include "header.php";

    // Verifica si hay una sesión activa y si el rol del usuario es igual a 1
    if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] == 1) { 
        include "../clases/Asignacion.php";
        $con = new Conexion();
        $conexion = $con->conectar();
        $idUsuario = $_SESSION['usuario']['id'];

        // Obtener el ID de la persona asociada al usuario
        $sql = "SELECT persona.id_persona AS idPersona
                FROM t_usuarios  AS usuario
                INNER JOIN t_persona AS persona
                ON usuario.id_persona = persona.id_persona 
                AND usuario.id_usuario = '$idUsuario'";
        $respuesta = mysqli_query($conexion, $sql);
        $idPersona = mysqli_fetch_array($respuesta)[0];            

        // Obtener los dispositivos asignados a la persona
        $sql = "SELECT
                    persona.id_persona AS idPersona,
                    CONCAT(persona.apellidos, ' ', persona.nombres) AS nombrePersona,
                    equipo.id_equipo AS idEquipo,
                    equipo.nombre AS nombreEquipo,
                    asignacion.id_asignacion AS idAsignacion,
                    asignacion.marca AS marca,
                    asignacion.modelo AS modelo,
                    asignacion.numero_asignacion AS numeroAsignacion,
                    asignacion.serial AS serial,
                    equipo.descripcion as imagen
                FROM
                    t_asignacion AS asignacion
                INNER JOIN t_persona AS persona
                ON
                    asignacion.id_persona = persona.id_persona
                INNER JOIN t_cat_equipo AS equipo
                ON
                    asignacion.id_equipo = equipo.id_equipo AND 
                    asignacion.id_persona = '$idPersona'";
        $respuesta = mysqli_query($conexion, $sql);
?>
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
                <h1 class="fw-light">Mis Dispositivos</h1>
                <p class="lead">Content</p>

                <div class="row">
                    <?php while($mostrar = mysqli_fetch_array($respuesta)) {?>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h4><span class="<?php echo $mostrar['imagen'];?>"></span>
                                <?php echo $mostrar['nombreEquipo']; ?></h4>
                                <ul>
                                    <li>numero Asignacion: <?php echo $mostrar['numeroAsignacion'];?></li>
                                    <li>serial: <?php echo $mostrar['serial'];?></li>
                                    <li>Marca: <?php echo $mostrar['marca'];?></li>
                                    <li>Modelo: <?php echo $mostrar['modelo'];?></li> 
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <?php  
    include "footer.php"; 
    } else {
        header("location:../index.html");
    }
?> 
