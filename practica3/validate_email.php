<?php
$email = $_GET['email'];
$url = "ejercicio6.html";
// Validación simple del correo electrónico
do {
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
echo "Dirección de correo no válida. Inténtalo de nuevo.<br>";
header('Location: ' . $url);
} else {
echo "Correo válido: $email";
}
} while (!filter_var($email, FILTER_VALIDATE_EMAIL));
