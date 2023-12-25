<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo $ruta?>/css/style">
  <title>Libreria ALV</title>
</head>
<body>
<h1>Biblioteca ALV</h1>
  <hr>
  <!-- Rutas con url amigables -->
  <a id="newBook" href="<?=$ruta?>/Libros">Agregar nuevo libro</a>
  <hr>
  <!-- modificar casi todo -->
  <?php
    foreach($data['libros'] as $libro)  {
    ?>
      <h3><?php echo $libro->getTitulo();?></h3>
      <p>Autor: <?php echo $libro->getAutor(); ?></p><br>
      <p id="width40"><?=$libro->getDescripcion();?></p><br>
      <a id="cssBorrar" href="<?php echo $ruta."/BorrarLibro/".$libro->getId();?>">Borrar libro</a>
    <?php
    }
  ?>
</body>
</html>