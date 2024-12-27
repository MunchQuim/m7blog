   <!--  php -->
   <?php 
   $nombre = "Quim";
   $edad = 27;
   $altura = 1.87;
   $tieneCoche = false;
   $cocheResultado = $tieneCoche ? "Si" : "No";
   $esFumador = false;
   $fumaResultado = $esFumador ? "Si" : "No";
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
    <?php echo "<h1>$nombre</h1>";
    
    echo "<p>Edad: $edad años</p>";
    echo "<p>Altura: $altura m</p>";
    echo "<p>$fumaResultado es fumador</p>";
    echo "<p>$cocheResultado tiene coche</p>";

    ?>

</body>
</html>