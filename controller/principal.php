<?php
  require_once "../model/ORM.inc.php";
  $nombreTabla = "Libro"; // Este es la variable con el nombre de la tabal para obtener todos los libros
  $arrBasename = explode("/",$_SERVER["REQUEST_URI"]);
  $ruta = "/".$arrBasename[1]."/".$arrBasename[2];
  // Obtiene todas los libros
  $ORM = new ORM();
  $data["libros"] = $ORM->findAll($nombreTabla);
  include_once "../view/listado.inc.php";
?>