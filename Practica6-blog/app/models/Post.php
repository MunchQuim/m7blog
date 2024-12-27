<?php

namespace models;

require_once 'app/config/Database.php';
class Post
{
    private $conn;
    private $table_name = 'posts';

    public $id;
    public $title;
    public $message;
    public $updated_at;
    public $created_at;
    public $themes_id;


    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getLastInsertId()
    {
        return $this->conn->lastInsertId(); // $this->db es tu instancia de PDO
    }
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (title, message, themes_id) VALUES (:title, :message, :themes_id)";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->themes_id = htmlspecialchars(strip_tags($this->themes_id));

        // Vincular los datos
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':message', $this->message);
        $stmt->bindParam(':themes_id', $this->themes_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read()
    {
        $query = 'SELECT p.*, t.tema,u.username,u.id as user_id FROM ' . $this->table_name . ' p JOIN themes t ON p.themes_id = t.id JOIN rel_users_posts r ON r.posts_id = p.id JOIN users u ON u.id = r.users_id';
        $stmt = $this->conn->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }
    public function readById()
    {

        $query = 'SELECT p.*, t.tema,u.username,u.id as user_id FROM ' . $this->table_name . ' p JOIN themes t ON p.themes_id = t.id JOIN rel_users_posts r ON r.posts_id = p.id JOIN users u ON u.id = r.users_id  WHERE p.id = :id';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET title = :title, message = :message, themes_id = :themes_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->themes_id = htmlspecialchars(strip_tags($this->themes_id));

        // Vincular los datos
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':message', $this->message);
        $stmt->bindParam(':themes_id', $this->themes_id);
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
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}