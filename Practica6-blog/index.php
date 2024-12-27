<?php

use controllers\ChatController;
use controllers\UserController;

require_once 'vendor/autoload.php'; // Asegúrate de haber configurado Composer paraautoloading
// Obtén la ruta desde la URL
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$dir = '/2DAW/Practica6-blog';
use config\Database;

use models\Post;
use models\Rel_user_post;
use models\Theme;
use models\User;
use models\Comment;
use models\Chat;
use models\Message;

// Instancia el controlador principal de los posts
require_once __DIR__ . '/app/config/Database.php';
require_once __DIR__ . '/app/controllers/PostController.php';
require_once __DIR__ . '/app/controllers/HomeController.php';
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/ChatController.php';
require_once __DIR__ . '/app/utils/auth.php';

$database = new Database();
$db = $database->getConnection();


$post = new Post($db);
$rel_user_post = new Rel_user_post($db);
$theme = new Theme($db);
$user = new User($db);
$comment = new Comment($db);
$chat = new Chat($db);
$message = new Message($db);

$db = null;

$postController = new PostController($post, $theme, $rel_user_post, $comment);
$homeController = new HomeController();
$userController = new UserController($user, $rel_user_post);
$chatController = new ChatController($user,$chat,$message);

// Enrutamiento básico
switch ($request) {
    case $dir . '/':
        $homeController->home($postController);
        break;
    case $dir . '/login':
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $homeController->login();
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $userController->handleLogin($_POST['email'], $_POST['password']);
            }
        }
        break;
    case $dir . '/register':
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $homeController->register();
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['email'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $confirmPassword = $_POST['confirm_password'];
                $email = $_POST['email'];
                // Llamar al método para manejar el inicio de sesión
                $userController->handleRegister($username, $password, $confirmPassword, $email);
            }
        }
        break;
    case $dir . '/logout':
        //deberia ser con post
        $homeController->logout();
        break;
    case $dir . '/users':
        if (comprobarRol('admin')) {
            $userController->index();
        }
        break;

    case $dir . '/users/create':
        // Solo muestra el formulario de creación si el método es GET
        comprobarSesion();
        if (comprobarRol('admin')) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $userController->create();
            } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['role'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $confirm_password = $_POST['confirm_password'];
                    $role = $_POST['role'];
                    $userController->handleRegisterByAdmin($username, $password, $confirm_password, $email, $role);
                }
                header('Location: ' . $dir . '/users');
                exit();
            }
        } else {
            //redirecciona a prohibido
        }
        break;
    case (preg_match('#^' . preg_quote($dir . '/users/view/', '#') . '([a-zA-Z0-9\-]+)/?$#', $request, $matches) ? true : false):
        //chat gpt para este tipo de routing

        $userId = $matches[1];
        $userController->view($userId);
        break;


    case (preg_match('#^' . preg_quote($dir . '/users/edit/', '#') . '([a-zA-Z0-9\-]+)/?$#', $request, $matches) ? true : false):
        $id = $matches[1];
        comprobarSesion();
        if (comprobarRol('admin')) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['role'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $role = $_POST['role'];
                    $userController->handleUpdateUser($id, $username, $email, $role);
                }


            } else {
                $userController->edit($id);
            }

        } else {
            //no permisos
        }

        break;
    case (preg_match('#^' . preg_quote($dir . '/users/delete/', '#') . '([a-zA-Z0-9\-]+)/?$#', $request, $matches) ? true : false):
        $id = $matches[1];
        comprobarSesion();
        if (comprobarRol('admin')) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $userController->handleDeleteUser($id);
            }
        } else {
            //no permisos
        }

        break;


    case $dir . '/posts':
        if (comprobarRol('admin')) {
            $postController->indexByOwner();
        } else {
            header('Location: ' . $dir . '/');
            exit();
        }

        break;
    case (preg_match('#^' . preg_quote($dir . '/posts/view/', '#') . '([a-zA-Z0-9\-]+)/?$#', $request, $matches) ? true : false):
        //chat gpt para este routing

        $postId = $matches[1];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            comprobarSesion();
            $user_id = $_SESSION['user_id'];
            if (isset($_POST['post_id']) && isset($_POST['comment'])) {
                $post_id = $_POST['post_id'];
                $comment = $_POST['comment'];
            }
            if (isset($_POST['comment_id'])) {
                $comment_id = $_POST['comment_id'];
            } else {
                $comment_id = null;
            }
            $postController->handleNewComment($user_id, $post_id, $comment, $comment_id);

        }

        $postController->view($postId);
        break;

    case (preg_match('#^' . preg_quote($dir . '/posts/edit/', '#') . '([a-zA-Z0-9\-]+)/?$#', $request, $matches) ? true : false):
        $postId = $matches[1];
        comprobarSesion();
        if (comprobarOwnership($postId) || comprobarRol('admin')) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['title']) && isset($_POST['message']) && isset($_POST['theme_id'])) {

                }
                $user_id = $_SESSION['user_id'];

                $postController->handleUpdatePost($postId, $_POST['title'], $_POST['message'], $_POST['theme_id']);
            }
            $postId = $matches[1];
            $postController->edit($postId);
        } else {
            //no permisos
        }

        break;

    case (preg_match('#^' . preg_quote($dir . '/posts/delete/', '#') . '([a-zA-Z0-9\-]+)/?$#', $request, $matches) ? true : false):
        $postId = $matches[1];
        comprobarSesion();
        if (comprobarOwnership($postId) || comprobarRol('admin')) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $postController->handleDeletePost($postId);
            }
        } else {
            //no permisos
        }

        break;
    case $dir . '/posts/create':
        // Solo muestra el formulario de creación si el método es GET
        comprobarSesion();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $postController->create();
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Si es POST, guarda el nuevo post
            if (isset($_SESSION['user_id']) && isset($_POST['title']) && isset($_POST['message']) && isset($_POST['theme_id'])) {
                echo 'a';
                $title = $_POST['title'];
                $content = $_POST['message'];
                $theme = $_POST['theme_id'];
                $postController->handleNewPost($_SESSION['user_id'], $title, $content, $theme);
            }
            header('Location: ' . $dir . '/');
            exit();
        }
        break;
    case $dir . '/messages/create':
        // Solo muestra el formulario de creación si el método es GET
        comprobarSesion();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['id_receptor'])&&isset($_POST['message'])&&isset($_SESSION['user_id'])){
                $chatController->handleCreateMessage($_SESSION['user_id'],$_POST['id_receptor'],$_POST['message']);
            }
        }
        break;

    /* 
        case $dir . '/blog':
            $postController->index(); // el metodo del controlador me lleva a la vista
            break; */

    // Agregar más casos según sea necesario
}
/* if (isset($_GET['id_receptor']) && !isset($_GET['id_usuario'])) {

   


} */
if (isset($_GET['id_receptor']) && isset($_GET['id_usuario'])) {
    //depurado chatgpt
    comprobarSesion();
    $user->id = $_GET['id_receptor'];
    $stmt = $user->readById();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if ($_GET['id_usuario'] == $_SESSION['user_id']) {
        $id_usuario = $_GET['id_usuario'];
        $id_receptor = $_GET['id_receptor'];
        $ultimoMensajeTimestamp = isset($_GET['last_message_timestamp']) ? $_GET['last_message_timestamp'] : 0;

        $timeout = 30; // Tiempo máximo para el Long Polling
        $start_time = time();

        do {
            // Obtener mensajes enviados y recibidos
            $chat->user1_id = $id_usuario;
            $chat->user2_id = $id_receptor;
            $stmt = $chat->getMessages();
            $enviados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $chat->user1_id = $id_receptor;
            $chat->user2_id = $id_usuario;
            $stmt = $chat->getMessages();
            $recibidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Combinar y ordenar los mensajes
            $mensajes = array_merge($enviados, $recibidos);
            usort($mensajes, function ($a, $b) {
                return strtotime($a['created_at']) - strtotime($b['created_at']);
            });

            // Filtrar mensajes nuevos
            $nuevosMensajes = array_filter($mensajes, function ($mensaje) use ($ultimoMensajeTimestamp) {
                return strtotime($mensaje['created_at']) > $ultimoMensajeTimestamp;
            });

            if (!empty($nuevosMensajes)) {
                $respuesta = [
                    'nuevosMensajes' => $nuevosMensajes,
                    'usuarioReceptor' => $row, // Información adicional del receptor
                ];
                echo json_encode($respuesta);
                exit;
            }

            // Esperar antes de verificar de nuevo
            usleep(500000); // Esperar 0.5 segundos
        } while (time() - $start_time < $timeout);

        // Responder vacío si no hay nuevos mensajes
        echo json_encode(['nuevosMensajes' => [], 'usuarioReceptor' => $row]);
    }
}
