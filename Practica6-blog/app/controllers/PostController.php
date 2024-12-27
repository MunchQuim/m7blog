<?php

use models\Post;
use models\Rel_user_post;
use models\Theme;
use models\Comment;
class PostController
{

    private $postModel;
    private $themeModel;

    private $commentModel;
    private $relationModel;

    public function __construct(Post $post, Theme $theme, Rel_user_post $rel, Comment $comment)
    {
        $this->postModel = $post;
        $this->themeModel = $theme;
        $this->relationModel = $rel;
        $this->commentModel = $comment;
    }
    //metodos que devuelven VISTAS con los datos obtenidos
    public function index()
    {
        /* $posts = $this->handleSeeAllPosts(); */
        $this->relationModel->relation = 'owner';
        $stmt = $this->relationModel->readPostUser();
        return $stmt;
    }
    public function view($post_id)
    {
        $this->postModel->id = $post_id;
        $stmt = $this->postModel->readById();

        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->commentModel->posts_id = $post_id;
        $stmt = $this->commentModel->readByPostId();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'app/views/post/view.php';
    }
    public function edit($post_id){
        $this->postModel->id = $post_id;
        $stmt = $this->postModel->readById();
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->themeModel->read();
        $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'app/views/post/edit.php';
    }

    public function ownedIndex($user_id)
    {
        $postArr = $this->handleSeeOwnedPosts($user_id);
        require_once 'app/views/home.php'; //cambiar
    }
    public function create()
    {
        $stmt = $this->themeModel->read();
        $themes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'app/views/post/create.php'; //cambiar
    }
    //metodos que devuelven o hacen cosas
    public function indexByOwner()
    {
        $this->relationModel->relation = 'owner';
        $stmt = $this->relationModel->readPostUser();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once 'app/views/post/index.php';
    }
    public function handleSeeAllPosts()
    {
        $stmt = $this->postModel->read();
        $allPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $allPosts;
    }

    public function handleNewPost($user_id,$title, $message, $theme_id)
    {
            $this->postModel->title = $title;
            $this->postModel->message = $message;
            $this->postModel->themes_id = $theme_id;


            if ($this->postModel->create()) {
                echo "Post creado con exito.";
                $post_id = $this->postModel->getLastInsertId();
                $this->relationModel->posts_id =  $post_id;
                $this->relationModel->users_id = $user_id;
                $this->relationModel->relation = 'owner';
                $this->relationModel->create();
            } else {
                echo "Error al crear el post.";
            }

    }
    public function handleNewComment($user_id, $post_id, $comment, $comment_id)
    {
        $this->commentModel->users_id = $user_id; 
        $this->commentModel->posts_id = $post_id; 
        $this->commentModel->message = $comment; 
        $this->commentModel->comments_id = $comment_id; 

        if ( $this->commentModel->create()) {
        } else {
            echo "Error al borrar el post";
        }

    }

    public function handleSeeOwnedPosts($user_id)
    {
        $this->relationModel->users_id = $user_id;
        $stmt = $this->relationModel->getOwnedPosts();

        $ownedPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $ownedPosts;
    }



    public function handleUpdatePost($id, $title, $message, $themes_id)
    {
        $this->postModel->id = $id;
        $this->postModel->title = $title;
        $this->postModel->message = $message;
        $this->postModel->themes_id = $themes_id;

        if ($this->postModel->update()) {
            header("Location: ".'/2DAW/Practica6-blog/posts/view/'.$id);
            exit();
        } else {
            echo "Error al actualizar el post";
        }
    }

    public function handleDeletePost($post_id)
    {
        $this->postModel->id = $post_id;
        if ($this->postModel->delete()) {
            header("Location: ".'/2DAW/Practica6-blog/posts');
            exit();
        } else {
            echo "Error al borrar el post";
        }
    }



}