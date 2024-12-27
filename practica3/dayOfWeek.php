<?php
// Recoger los datos enviados con GET
$day = $_GET['day'];
// Mostrar los datos
switch ($day) {
    case 'Lunes':
    case 'Martes':
    case 'Miercoles':
    case 'Jueves':
    case 'Viernes':
        echo "Abiertos de 9am-8pm";
        break;
    case 'Sabado':
        echo "Abiertos de 10am-6pm";
        break;
    case 'Domingo':
        echo "Cerrado";
        break;

    default:
        echo "Upsi";
        break;
}

?>