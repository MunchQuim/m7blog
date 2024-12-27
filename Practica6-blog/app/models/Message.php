<?php

namespace models;
require_once 'app/config/Database.php';
class Message
{
    private $conn;
    private $table_name = 'messages';

    public $chat_user1_id;
    public $chat_user2_id;
    public $message;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Métodos CRUD para el usuario (create, read, update, delete)
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (chats_user1_id, chats_user2_id, message) VALUES (:chats_user1_id, :chats_user2_id, :message)";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->chat_user1_id = htmlspecialchars(strip_tags($this->chat_user1_id));
        $this->chat_user2_id = htmlspecialchars(strip_tags($this->chat_user2_id));
        $this->message = htmlspecialchars(strip_tags($this->message));

        // Vincular los datos
        $stmt->bindParam(':chats_user1_id', $this->chat_user1_id);
        $stmt->bindParam(':chats_user2_id', $this->chat_user2_id);
        $stmt->bindParam(':message', $this->message);

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
        $query = "UPDATE " . $this->table_name . " SET chat_user1_id = :chat_user1_id, chat_user2_id = :chat_user2_id, message = :message WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->chat_user1_id = htmlspecialchars(strip_tags($this->chat_user1_id));
        $this->chat_user2_id = htmlspecialchars(strip_tags($this->chat_user2_id));
        $this->message = htmlspecialchars(strip_tags($this->message));

        // Vincular los datos
        $stmt->bindParam(':chat_user1_id', $this->chat_user1_id);
        $stmt->bindParam(':chat_user2_id', $this->chat_user2_id);
        $stmt->bindParam(':message', $this->message);


        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE chat_user1_id = :chat_user1_id AND chat_user2_id = :chat_user2_id";
        $stmt = $this->conn->prepare($query);

         // Sanitizar los datos
         $this->chat_user1_id = htmlspecialchars(strip_tags($this->chat_user1_id));
         $this->chat_user2_id = htmlspecialchars(strip_tags($this->chat_user2_id));
 
         // Vincular los datos
         $stmt->bindParam(':chat_user1_id', $this->chat_user1_id);
         $stmt->bindParam(':chat_user2_id', $this->chat_user2_id);
 

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}