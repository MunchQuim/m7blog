   <!--  php -->
   <?php 
   $nombreAutor = "Joaquim";
   $nacionalidadAutor = "España";
   define("ANO_NACIMIENTO",1997);
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
    <?php echo "<h1>El autor: $nombreAutor </h1>";
    echo "<p>de nacionalidad: $nacionalidadAutor</p>";
    echo "<p>nacio en el año: ". ANO_NACIMIENTO." </p>";
    ?>

</body>
</html>