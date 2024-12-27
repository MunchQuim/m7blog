<?php
// Recoger los datos enviados con GET
$gasto = $_GET['gasto'];
// Mostrar los datos
if ($gasto>300) {
    echo "¡Enhorabuena! Has desbloqueado acceso VIP";
}else{
    echo "Lo sentimos,no calificas para acceso VIP";
} ?>