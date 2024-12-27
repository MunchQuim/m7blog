<?php
// Recoger los datos enviados con GET
$puntuaciones = $_GET['puntuacion'];
// Mostrar los datos
foreach ($puntuaciones as $artista => $punt) {
    if ($punt >= 90) {
        echo "$artista :Medalla de Oro";
    } elseif($punt >= 75){
        echo "$artista :Medalla de Plata";
    } elseif($punt >= 60){
        echo "$artista :Medalla de Bronce";
    } else{
        echo "$artista :No se ha asignado medalla";
    }
    echo"<br>";
}

 ?>