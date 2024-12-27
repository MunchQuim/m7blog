<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Galería de Gatos</title>
</head>

<body>
    <h1>Mi Galería de Gatos</h1>
    <?php
    for ($i = 1; $i <= 5; $i++) {
        echo "<img src='./img/gato" . $i . ".jfif' alt='cat Image " . $i . "'><br>";
    }
    ?>
</body>

</html>