<?php
namespace models;
require_once 'app/config/Database.php';
class Comment
{
    private $conn;
    private $table_name = 'comments';

    public $id;
    public $posts_id;
    public $users_id;
    public $created_at;
    public $message;
    public $comments_id;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Métodos CRUD para el usuario (create, read, update, delete)
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (posts_id, users_id, message, comments_id) VALUES (:posts_id, :users_id, :message, :comments_id)";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->posts_id = htmlspecialchars(strip_tags($this->posts_id));
        $this->users_id = htmlspecialchars(strip_tags($this->users_id));
        $this->message = htmlspecialchars(strip_tags($this->message));
        /* $this->comments_id = htmlspecialchars(strip_tags($this->comments_id)); */

        // Vincular los datos
        $stmt->bindParam(':posts_id', $this->posts_id);
        $stmt->bindParam(':users_id', $this->users_id);
        $stmt->bindParam(':message', $this->message);
        $stmt->bindParam(':comments_id', $this->comments_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }
    public function readByPostId()
    {
        $query = "SELECT c.*, u.username FROM " . $this->table_name . ' c JOIN users u ON u.id = c.users_id WHERE posts_id = :posts_id ORDER BY created_At';
        $stmt = $this->conn->prepare($query);
        $this->posts_id = htmlspecialchars(strip_tags($this->posts_id));
        $stmt->bindParam(':posts_id', $this->posts_id);
        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET posts_id = :posts_id, users_id = :users_id, created_at = :created_at, message = :message, comments_id = :comments_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->posts_id = htmlspecialchars(strip_tags($this->posts_id));
        $this->users_id = htmlspecialchars(strip_tags($this->users_id));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->comments_id = htmlspecialchars(strip_tags($this->comments_id));

        // Vincular los datos
        $stmt->bindParam(':posts_id', $this->posts_id);
        $stmt->bindParam(':users_id', $this->users_id);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':message', $this->message);
        $stmt->bindParam(':comments_id', $this->comments_id);
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Vincular los datos       
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}