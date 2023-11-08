<?php
include "../../clases/conexion.php";

// Crear instancia de la clase de conexión
$con = new Conexion();
$conexion = $con->conectar();

// Consulta SQL para obtener los datos de asignación
$sql = "SELECT
            persona.id_persona AS idPersona,
            CONCAT(persona.nombres) AS nombrePersona,
            equipo.id_equipo AS idEquipo,
            equipo.nombre AS nombreEquipo,
            asignacion.id_asignacion AS idAsignacion,
            asignacion.marca AS marca,
            asignacion.modelo AS modelo,
            asignacion.numero_asignacion AS numeroAsignacion,
            asignacion.serial AS serial
        FROM
            t_asignacion AS asignacion
            INNER JOIN t_persona AS persona ON asignacion.id_persona = persona.id_persona
            INNER JOIN t_cat_equipo AS equipo ON asignacion.id_equipo = equipo.id_equipo";

// Ejecutar la consulta SQL
$respuesta = mysqli_query($conexion, $sql);
?>

<table class="table table-sm dt-responsive nowrap" id="tablaAsignacionDataTable" style="width:100%">
    <thead>
        <th>Persona</th>
        <th>Equipo</th>
        <th>Numero Asignacion</th>
        <th>Serial</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Eliminar</th>
    </thead>
    <tbody>
    <?php while ($mostrar = mysqli_fetch_array($respuesta)) { ?>
        <tr>
            <td><?php echo $mostrar['nombrePersona'] ?></td>
            <td><?php echo $mostrar['nombreEquipo'] ?></td>
            <td><?php echo $mostrar['numeroAsignacion'] ?></td>
            <td><?php echo $mostrar['serial'] ?></td>
            <td><?php echo $mostrar['marca'] ?></td>
            <td><?php echo $mostrar['modelo'] ?></td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="eliminarAsigancion(<?php echo $mostrar['idAsignacion'] ?>)">
                    Eliminar
                </button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#tablaAsignacionDataTable').DataTable();
    });
</script>
