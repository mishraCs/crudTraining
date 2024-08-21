<?php
namespace Controller;

abstract class CreateConnection {
    private $host;
    private $userName; 
    private $password;
    private $database;
    protected $conn;
    public function connectionMysqli() {
        $this->host = "localhost";
        $this->userName = "root";
        $this->password = "";
        $this->database = "php";
        $this->conn = new \mysqli($this->host, $this->userName, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

?>
