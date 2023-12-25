<?php
  require_once "../model/ORM.inc.php";
  $tablaBorrar = "Libro"; // Variavle con el nombre de la tabla para poder ser borrada
  $arrBasename = explode("/",$_SERVER["REQUEST_URI"]);
  $ruta = "/".$arrBasename[1]."/".$arrBasename[2];
  $id = $_GET["id"];
  $ORM = new ORM();
  $ORM->delete($tablaBorrar,$id);
  header("Location: ".$ruta);
?>
