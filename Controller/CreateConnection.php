<?php
namespace ConnectionDb;
abstract class CreateConnection{
    private $host;
    private $userName; 
    private $password;
    private $database;
    public  $conn;
    public function __construct() {
        $this->host = "localhost";
        $this->userName = "root";
        $this->password = "";
        $this->database = "php";
        try {
            $this->conn = mysqli_connect($this->host, $this->userName, $this->password, $this->database);
            return $this->conn;
        } catch (\Throwable $th) {
            echo $th->getmessage();
        }
    }
}
?>