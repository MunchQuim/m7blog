<?php
// deprecado

/* require_once 'config/Database.php';
require_once 'models/User.php';
require_once 'controllers/UserController.php'; */
use config\Database;
use models\User;
use models\Rel_user_post;
use controllers\UserController;
// Crear una nueva conexión a la base de datos
$db = (new Database())->getConnection();
// Crear una nueva instancia de User y UserController
$user = new User($db);
$rel_user_post = new Rel_user_post($db);

$userController = new UserController($user,$rel_user_post) ;
// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];
// Llamar al método para manejar el inicio de sesión
$userController->handleLogin($username, $password);
