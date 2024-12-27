<?php

require_once 'app/controllers/UserController.php';
require_once 'app/controllers/PostController.php';
class HomeController
{
    public function __construct()
    {

    }

    public function home($postController){
        //llamar a 

        $posts = $postController->handleSeeAllPosts();/* 
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC); */
        require_once 'app/views/home/home.php';
    }
    public function login(){
        require_once 'app/views/home/login.php';
    }
    public function register(){
        require_once 'app/views/home/register.php';
    }
    public function logout(){
        require_once 'app/utils/logout.php';
    }
}