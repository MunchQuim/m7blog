   <!--  php -->
   <?php 
   $usuario = "Joaquimpinsot";
   $colorFavorito = null;
   ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
   
<?php 
    echo " <p>El usuario $usuario:</p>";echo $colorFavorito ? "<p>ha escogido el $colorFavorito como su color favorito</p>" : "<p> no ha escogido un color favorito</p>" 
    ?>
</body>
</html>