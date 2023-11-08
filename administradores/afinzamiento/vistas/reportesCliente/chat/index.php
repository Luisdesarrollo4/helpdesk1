<!DOCTYPE html>
<html>
 <head>
  <script src="jquery.min.js"></script>
  <script src="chat.js"></script>
  <link href="chat.css" rel="stylesheet"/>
 </head>
 <body>
  <br>
	<div id="konten">
   <div class="chat">
     <?php 
    if (isset($_GET['id'])) {
      $idUsuario = $_GET['id'];
      
      // Realiza la conexión a la base de datos (reemplaza con tu configuración)
      $servername = "localhost";
      $username = "root";
      $password = "root";
      $dbname = "helpdesk1";

      $conn = new mysqli($servername, $username, $password, $dbname);

      // Verifica la conexión
      if ($conn->connect_error) {
        die("La conexión a la base de datos falló: " . $conn->connect_error);
      }

      // Consulta SQL para obtener el nombre y apellido del usuario
      $sql = "SELECT persona.nombres, persona.apellidos
              FROM t_usuarios as usuarios
              INNER JOIN t_persona as persona ON usuarios.id_persona = persona.id_persona
              WHERE usuarios.id_usuario = $idUsuario";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // Se encontró el usuario
        $row = $result->fetch_assoc();
        $nombres = $row["nombres"];
        $apellidos = $row["apellidos"];
        
        echo "Nombre del usuario: $nombres $apellidos";
      } else {
        echo "No se encontró ningún usuario con el ID proporcionado.";
      }

      // Cierra la conexión a la base de datos
      $conn->close();
    } else {
      echo "No se proporcionó un valor para 'id'.";
    }
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      echo "El valor de 'id' es: " . $id;
    } else {
      echo "No se proporcionó un valor para 'id'.";
    }   
      include("config.php");include("login.php");
        if(isset($_SESSION['user'])){
          include("chatbox.php");
        }else{
          $display_case=true;
          include("login.php");
        }
        
        ?>
        <div>
            
        </div>
      </div>
      <div class="users" style='display:none'>
        <?php include("users.php");?>*/
    </div>
	</div>
 </body>
</html>
    