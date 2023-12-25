<?php
  $arrBasename = explode("/",$_SERVER["REQUEST_URI"]);
  $ruta = "/".$arrBasename[1]."/".$arrBasename[2];
  include_once "../view/formularioLibro.inc.php";
?>