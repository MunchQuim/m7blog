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

$db = null;

$userController = new UserController($user,$rel_user_post) ;
// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];
$email = $_POST['email'];
// Llamar al método para manejar el inicio de sesión
$userController->handleRegister($username, $password, $confirmPassword, $email);