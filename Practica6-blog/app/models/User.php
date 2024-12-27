<?php

namespace models;
use PDO;
require_once 'app/config/Database.php';
class User
{
    private $conn;
    private $table_name = 'users';

    // Propiedades del usuario (id, username, email, etc.)
    public $id;
    public $username;
    public $password;
    public $email;
    public $role;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Métodos CRUD para el usuario (create, read, update, delete)
// Método para registrar un nuevo usuario
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (username, password, email, role) VALUES (:username, :password, :email, :role)";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->role = htmlspecialchars(strip_tags($this->role));

        // Vincular los datos
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':password', password_hash($this->password,PASSWORD_DEFAULT)); // Hashear la contraseña
        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY email ASC";
        $stmt = $this->conn->prepare($query);

        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }
    public function readById()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }
    public function readUserOwnedPostsById()
    {
        $query = "SELECT 
        u.id as user_id, u.username, u.email, u.role,
        p.id as post_id, p.title, p.message as post_message,
        t.tema        
        FROM " . $this->table_name . " u 
        JOIN rel_users_posts r ON r.users_id = u.id
        JOIN posts p ON p.id = r.posts_id
        JOIN themes t ON t.id = p.themes_id
        WHERE u.id = :id AND r.relation = 'owner'";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }
    public function readUserCommentsById()
    {
        $query = "SELECT 
        u.id as user_id, u.username, u.email, u.role,
        c.id as comment_id, c.message as comment_message        
        FROM " . $this->table_name . " u 
        JOIN comments c ON c.users_id = u.id
        WHERE u.id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }
    public function readAllById()
    {
        $query = "SELECT 
        u.id as user_id, u.username, u.email, u.role,
        p.id as post_id, p.title, p.message as post_message,
        t.tema,
        c.id as comment_id, c.message as comment_message        
        FROM " . $this->table_name . " u 
        JOIN rel_users_posts r ON r.users_id = u.id
        JOIN posts p ON p.id = r.posts_id
        JOIN comments c ON c.users_id = u.id 
        JOIN themes t ON t.id = p.themes_id
        WHERE u.id = :id AND r.relation = 'owner'";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }
    

    public function login()
    {
        $query = "SELECT id, username, password, email FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        // Sanitizar y vincular datos
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($this->password, $row['password'])) {
                // Credenciales válidas
                $this->id = $row['id'];
                $this->username = $row['username'];
                return true;
            }
        }
        return false;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET username = :username, email = :email, role = :role WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->email = htmlspecialchars(strip_tags($this->email));
       /*  $this->password = htmlspecialchars(strip_tags($this->password)); */
        $this->role = htmlspecialchars(strip_tags($this->role));

        // Vincular los datos
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);
       /*  $stmt->bindParam(':password', password_hash(
            $this->password,
            PASSWORD_DEFAULT
        )); */ // Hashear la contraseña
        $stmt->bindParam(':role', $this->role);
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