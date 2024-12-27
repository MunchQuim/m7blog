<?php

use config\Database;
use models\User;//mejorar
use models\Rel_user_post;//mejorar

function comprobarSesion()
{
    if (session_status() == 1) {
        session_start();
    }
    if (!isset($_SESSION['user_id'])) {
        // Si no hay sesión, redirigir a la página de inicio de sesión
        header("Location: ../views/home/home.php");
        exit();
    }
}
function comprobarOwnership($postId)
{
    if (session_status() == 1) {
        session_start();
    }
    if (isset($_SESSION['user_id'])) {
        require_once __DIR__ . '/../controllers/UserController.php';
        require_once __DIR__ . '/../models/User.php';
        require_once __DIR__ . '/../config/Database.php';
        $database = new Database();
        $db = $database->getConnection();
        $rel_user_post = new Rel_user_post($db);
        $rel_user_post->users_id = $_SESSION['user_id'];
        $rel_user_post->posts_id = $postId;
        $stmt = $rel_user_post->getRelation();
        $relation = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($relation) {
            if ($relation['relation'] == 'owner') {
                return true;
            } else {
                return false;
            }
        }
        else{
            return false; 
        }

    }
}

function comprobarRol($rolNecesario)
{
    if (session_status() == 1) {
        session_start();
    }
    if (isset($_SESSION['user_id'])) {
        require_once __DIR__ . '/../controllers/UserController.php';
        require_once __DIR__ . '/../models/User.php';
        require_once __DIR__ . '/../config/Database.php';
        $database = new Database();
        $db = $database->getConnection();
        $user = new User($db);
        $user->id = $_SESSION['user_id'];
        $stmt = $user->readById();
        $myUser = $stmt->fetch(PDO::FETCH_ASSOC);
        $db = null;
        if ($myUser['role'] == $rolNecesario) {
            return true;
        } else {
            return false;
        }
    }
}
function roleMiddleware($rolNecesario)
{
    if (session_status() == 1) {
        session_start();
    }
    if (isset($_SESSION['user_id'])) {
        require_once __DIR__ . '/../controllers/UserController.php';
        require_once __DIR__ . '/../models/User.php';
        require_once __DIR__ . '/../config/Database.php';
        $database = new Database();
        $db = $database->getConnection();
        $user = new User($db);
        $user->id = $_SESSION['user_id'];
        $stmt = $user->readById();
        $myUser = $stmt->fetch(PDO::FETCH_ASSOC);
        $db = null;
        if ($myUser['role'] != $rolNecesario) {
            header("Location: /" . __DIR__ . "/404.php"); // cambiar a prohibido
            exit();
        }
    }
}