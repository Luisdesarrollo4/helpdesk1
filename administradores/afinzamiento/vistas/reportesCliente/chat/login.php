<br/><br/>
<?php 
// Descargado de la pagina http://tusolutionweb.blogspot.pe/
//SIGUENOS
//Siguenos en twitter
//https://twitter.com/tusolutionweb
//Vista nuestra pagina web
//http://tusolutionweb.blogspot.com/
//Siguenos en facebook
//https://www.facebook.com/CodigofuenteGratis/
if(isset($_POST['name']) && !isset($display_case)){
 $name=htmlspecialchars($_POST['name']);
 $sql=$dbh->prepare("SELECT name FROM chatters WHERE name=?");
 $sql->execute(array($name));
 if($sql->rowCount()!=0 || $_POST['name'] == ""){
  $ermsg="<div class='error'>Nama sudah terpakai. Coba gunakan nama yang lain.</div>";
 }else{
  $sql=$dbh->prepare("INSERT INTO chatters (name,seen) VALUES (?,NOW())");
  $sql->execute(array($name));
  $_SESSION['user']=$name;
 }
}elseif(isset($display_case)){
 if(!isset($ermsg)){
?>
 <form action="index.php" method="POST">
  <input name="name" class="feedback-input" placeholder="Nombre" required/>
  <button id="button-blue">Registrar nombre</button>
 </form>
<?php 
 }else{
?>
 <form action="index.php" method="POST">
  <input name="name" class="feedback-input" placeholder="Nama kamu" required/>
  <button id="button-blue">Masuk</button>
 </form>
<?php 
  echo $ermsg;
 }
 echo '<p></p>';
}
// Descargado de la pagina http://tusolutionweb.blogspot.pe/
//SIGUENOS
//Siguenos en twitter
//https://twitter.com/tusolutionweb
//Vista nuestra pagina web
//http://tusolutionweb.blogspot.com/
//Siguenos en facebook
//https://www.facebook.com/CodigofuenteGratis/
?>
<footer>Visita  la pagina <a href="http://tusolutionweb.blogspot.pe/" target="_BLANK">descargado de </a> tusolutionweb <a href="http://tusolutionweb.blogspot.pe/" target="_BLANK">@bachors</a></footer>
