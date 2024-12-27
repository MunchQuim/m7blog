   <!--  php -->
   <?php 
   $projectName = "Proyecto tortuga";
   $description = "Una maravillosa aplicación web donde poder organizar tu tiempo de trabajo y de ocio.";
   $startYear = 2023;
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
<?php echo "<h1>$projectName</h1>";    
    echo "<p>$description</p>"."<p>Iniciado en: $startYear</p>";
    ?>
</body>
</html>