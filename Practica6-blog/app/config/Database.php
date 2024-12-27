<?php

namespace config;

use PDO;
use PDOException;
class Database
{
    private $host = 'localhost';
    private $db_name = 'myBlog';
    private $username = 'root'; // Cambiar según tu configuración
    private $password = 'finnelhumano'; // Cambiar según tu configuración
    public $conn;
    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec('set names utf8');
        } catch (PDOException $exception) {
            echo 'Error de conexión: ' . $exception->getMessage();
        }
        return $this->conn;
    }
}