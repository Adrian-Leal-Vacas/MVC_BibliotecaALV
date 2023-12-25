<?php
  require_once "../model/Libro.inc.php";
  require_once "../model/ORM.inc.php";
  $arrBasename = explode("/",$_SERVER["REQUEST_URI"]);
  $ruta = "/".$arrBasename[1]."/".$arrBasename[2];
  // creo el libro sin id porque el id lo voy a generar automaticamnte con el persist del ORM
  $ofertaAux = new Libro("", $_POST["titulo"], $_POST["autor"], $_POST["descripcion"]);
  // Inicializo el ORM
  $ORM = new ORM();
  $ORM->persist($ofertaAux);
  /* Funciona el flush bien porque como en el orm cambio el objeto todo en su totalidad
  gracias a "&" pues me pilla el id que se le ha otorgado en el persist  */
  $ORM->flush($ofertaAux);
  header("Location: ".$ruta);
?>