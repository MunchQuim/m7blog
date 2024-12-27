<?php
// Recoger los datos enviados con GET
$level = $_GET['level'];
// Mostrar los datos
if ($level >= 15) {
    echo "Puedes participar en el torneo";
} else {
    echo "Lo sentimos, no tienes el nivel suficiente para participar";
} ?>