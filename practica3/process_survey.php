<?php
// Recogemos la opinión seleccionada
$opinion = $_GET['opinion'];
// Creamos un array con las opciones de respuesta
$responses = [
    "option1" => "Excelente",
    "option2" => "Bueno",
    "option3" => "Regular",
    "option4" => "Ninguna de las anteriores"
];
// Recorremos el array de respuestas
foreach ($responses as $key => $value) {
    if ($key == $opinion) {
        if ($key == "option4") {
            echo "Gracias por tu tiempo, pero no has seleccionado ninguna
de las opciones.";
            break; // Detenemos el bucle si es "Ninguna de las anteriores"
        } else {
            echo "Has seleccionado: " . $value;
        }
    }
}
?>