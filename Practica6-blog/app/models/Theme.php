<?php

namespace models;
require_once 'app/config/Database.php';
class Theme
{
    private $conn;
    private $table_name = 'themes';

    public $id;
    public $tema;



    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " (tema) VALUES (:tema)";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->tema = htmlspecialchars(strip_tags($this->tema));

        // Vincular los datos
        $stmt->bindParam(':tema', $this->tema);

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
    public function getIdByTheme()
    {
        $query = "SELECT id FROM " . $this->table_name . ' WHERE tema = :tema';
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->tema = htmlspecialchars(strip_tags($this->tema));

        // Vincular los datos
        $stmt->bindParam(':tema', $this->tema);
        
        // Ejecutar la consulta
        $stmt->execute();
        return $stmt;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET tema = :tema WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitizar los datos
        $this->tema = htmlspecialchars(strip_tags($this->tema));

        // Vincular los datos
        $stmt->bindParam(':tema', $this->tema);
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