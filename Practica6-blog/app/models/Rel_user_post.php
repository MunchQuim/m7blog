<?php

namespace models;
require_once 'app/config/Database.php';
class Rel_user_post
{
    private $conn;
    private $table_name = 'rel_users_posts';
    private $posts_name = 'posts';
    private $users_name = 'users';

    public $users_id;
    public $posts_id;
    public $relation;



    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (users_id, posts_id, relation) VALUES (:users_id, :posts_id, :relation)";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->users_id = htmlspecialchars(strip_tags($this->users_id));
        $this->posts_id = htmlspecialchars(strip_tags($this->posts_id));
        $this->relation = htmlspecialchars(strip_tags($this->relation));

        // Vincular los datos
        $stmt->bindParam(':users_id', $this->users_id);
        $stmt->bindParam(':posts_id', $this->posts_id);
        $stmt->bindParam(':relation', $this->relation);

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
    public function readPostUser()
    {
        $query = "SELECT p.*, u.id as user_id, u.username, r.relation, t.tema
            FROM " . $this->posts_name . " p
            JOIN ".$this->table_name . " r ON p.id = r.posts_id
            JOIN ".$this->users_name." u ON r.users_id = u.id
            JOIN themes t ON p.themes_id = t.id
            WHERE r.relation = :relation";
        
        $stmt = $this->conn->prepare($query);
        $this->relation = htmlspecialchars(strip_tags($this->relation));
        $stmt->bindParam(':relation',$this->relation);
        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }
    public function getRelation()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE users_id = :users_id and posts_id = :posts_id";
        $stmt = $this->conn->prepare($query);

        $this->users_id = htmlspecialchars(strip_tags($this->users_id));
        $this->posts_id = htmlspecialchars(strip_tags($this->posts_id));
        $stmt->bindParam(':users_id', $this->users_id);
        $stmt->bindParam(':posts_id', $this->posts_id);
        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }
    public function getOwnedPosts()
    {
        $query = "SELECT * FROM " . $this->table_name . ' WHERE users_id = :users_id AND relation = owner';
        $stmt = $this->conn->prepare($query);

        $this->users_id = htmlspecialchars(strip_tags($this->users_id));
        $stmt->bindParam(':users_id', $this->users_id);

        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET relation = :relation WHERE users_id = :users_id AND posts_id = :posts_id";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->users_id = htmlspecialchars(strip_tags($this->users_id));
        $this->posts_id = htmlspecialchars(strip_tags($this->posts_id));
        $this->relation = htmlspecialchars(strip_tags($this->relation));

        // Vincular los datos
        $stmt->bindParam(':users_id', $this->users_id);
        $stmt->bindParam(':posts_id', $this->posts_id);
        $stmt->bindParam(':relation', $this->relation);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE users_id = :users_id AND posts_id = :posts_id";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->users_id = htmlspecialchars(strip_tags($this->users_id));
        $this->posts_id = htmlspecialchars(strip_tags($this->posts_id));

        // Vincular los datos
        $stmt->bindParam(':users_id', $this->users_id);
        $stmt->bindParam(':posts_id', $this->posts_id);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}