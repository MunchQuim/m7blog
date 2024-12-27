<?php
namespace controllers;
use models\User;
use models\Rel_user_post;
/* use models\Post;
use models\Comment;
use models\Theme; */

use PDO;
class UserController
{

    private $userModel;

    private $relationModel;

    public function __construct(User $user, Rel_user_post $rel)
    {
        $this->userModel = $user;
        $this->relationModel = $rel;
    }

    public function handleLogin($email, $password)
    {
        $this->userModel->email = $email;
        $this->userModel->password = $password;
        if ($this->userModel->login()) {

            // Iniciar sesión y establecer variables de sesión
            session_start();
            $_SESSION['user_id'] = $this->userModel->id;
            $_SESSION['username'] = $this->userModel->username;
            header("Location: http://localhost/2DAW/Practica6-blog");
            exit();
        } else {
            echo "Correo o contraseña incorrectos.";
        }
    }

    public function edit($user_id)
    {
        $this->userModel->id = $user_id;
        $stmt = $this->userModel->readById();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        require_once 'app/views/user/edit.php';
    }
    public function view($userId)
    {
        $this->userModel->id = $userId;
        $stmt = $this->userModel->readById();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt = $this->userModel->readUserOwnedPostsById();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $this->userModel->readUserCommentsById();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once 'app/views/user/view.php';
    }
    public function handleRegister($username, $password, $confirmPassword, $email)
    {
        if ($password == $confirmPassword) {
            $this->userModel->username = $username;
            $this->userModel->password = $password;
            $this->userModel->email = $email;
            $this->userModel->role = 'user';
            if ($this->userModel->create()) {
                $this->handleLogin($email, $password);
            }
        }
    }
    public function handleDeleteUser($id)
    {
        $this->userModel->id = $id;
        if ($this->userModel->delete()) {
            header("Location: " . '/2DAW/Practica6-blog/users');
            exit();
        } else {
            echo "Error al borrar el post";
        }
    }
    public function handleUpdateUser($id, $username, $email, $role)
    {
        $this->userModel->id = $id;
        $this->userModel->username = $username;
        $this->userModel->email = $email;
        $this->userModel->role = $role;

        if ($this->userModel->update()) {
            header("Location: " . '/2DAW/Practica6-blog/users');
            exit();
        } else {
            echo "Error al actualizar el post";
        }
    }
    public function handleRegisterByAdmin($username, $password, $confirmPassword, $email, $role)
    {
        if ($password == $confirmPassword) {
            $this->userModel->username = $username;
            $this->userModel->password = $password;
            $this->userModel->email = $email;
            $this->userModel->role = $role;
            $this->userModel->create();
        }
    }
    public function index()
    {
        $stmt = $this->userModel->read();
        $users = $stmt->fetchAll();
        require_once 'app/views/user/index.php';
    }
    public function create()
    {
        require_once 'app/views/user/create.php';
    }
}