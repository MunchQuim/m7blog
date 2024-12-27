<?php

namespace models;
require_once 'app/config/Database.php';
class Question
{
    private $conn;
    private $table_name = 'questions';

    public $id;
    public $title;
    public $message;
    public $users_id;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Métodos CRUD para el usuario (create, read, update, delete)
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (title, message, users_id) VALUES (:title, :message, :users_id)";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->user_id = htmlspecialchars(strip_tags($this->users_id));

        // Vincular los datos
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':message', $this->message);
        $stmt->bindParam(':users_id', $this->users_id);

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

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET title = :title, message = :message, users_id = :users_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->message = htmlspecialchars(strip_tags($this->message));
        $this->user_id = htmlspecialchars(strip_tags($this->users_id));

        // Vincular los datos
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':message', $this->message);
        $stmt->bindParam(':users_id', $this->users_id);
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