<?php
namespace models;
require_once 'app/config/Database.php';
class Chat
{
    private $conn;
    private $table_name = 'chats';

    // Propiedades del usuario (id, username, email, etc.)
    public $user1_id;
    public $user2_id;
    public $isBlocked;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Métodos CRUD para el usuario (create, read, update, delete)
// Método para registrar un nuevo usuario
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (user1_id, user2_id) VALUES (:user1_id, :user2_id)";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->user1_id = htmlspecialchars(strip_tags($this->user1_id));
        $this->user2_id = htmlspecialchars(strip_tags($this->user2_id));

        // Vincular los datos
        $stmt->bindParam(':user1_id', $this->user1_id);
        $stmt->bindParam(':user2_id', $this->user2_id);

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
    public function readById()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user1_id = :user1_id AND user2_id = :user2_id";
        $stmt = $this->conn->prepare($query);

        $this->user1_id = htmlspecialchars(strip_tags($this->user1_id));
        $this->user2_id = htmlspecialchars(strip_tags($this->user2_id));

        // Vincular los datos
        $stmt->bindParam(':user1_id', $this->user1_id);
        $stmt->bindParam(':user2_id', $this->user2_id);
        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }
    public function getMessages(){
        $query = "SELECT * FROM messages where chats_user1_id = :chats_user1_id AND chats_user2_id = :chats_user2_id";
        $stmt = $this->conn->prepare($query);

        $this->user1_id = htmlspecialchars(strip_tags($this->user1_id));
        $this->user2_id = htmlspecialchars(strip_tags($this->user2_id));

        $stmt->bindParam(':chats_user1_id', $this->user1_id);
        $stmt->bindParam(':chats_user2_id', $this->user2_id);
        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET isBlocked = :isBlocked WHERE user1_id = :user1_id AND user2_id = :user2_id";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->user1_id = htmlspecialchars(strip_tags($this->user1_id));
        $this->user2_id = htmlspecialchars(strip_tags($this->user2_id));
        $this->isBlocked = htmlspecialchars(strip_tags($this->isBlocked));

        // Vincular los datos
        $stmt->bindParam(':user1_id', $this->user1_id);
        $stmt->bindParam(':user2_id', $this->user2_id);
        $stmt->bindParam(':isBlocked', $this->isBlocked);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE user1_id = :user1_id AND user2_id = :user2_id";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->user1_id = htmlspecialchars(strip_tags($this->user1_id));
        $this->user2_id = htmlspecialchars(strip_tags($this->user2_id));

        // Vincular los datos       
        $stmt->bindParam(':user1_id', $this->user1_id);
        $stmt->bindParam(':user2_id', $this->user2_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}