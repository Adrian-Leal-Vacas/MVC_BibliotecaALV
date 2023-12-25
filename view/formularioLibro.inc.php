<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $ruta?>/css/style">
    <title>Libreria ALV</title>
</head>
<body>
     <form action="<?= $ruta;?>/GrabarLibro"  enctype="multipart/form-data" method="POST">
     <label for="titulo">Titulo</label><br>
     <input type="text" id="titulo" name="titulo"><br><br>
     <label for="autor">Autor</label><br>
     <input type="text" id="autor" name="autor"><br><br>
     <label for="descripcion">Descripción</label><br>
      <textarea name="descripcion" cols="60" rows="6" id="descripcion"></textarea><br><br>
      <input type="submit" value="Aceptar">
    </form>
</body>
</html>