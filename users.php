<?php 

abstract class MakeTable{
    abstract protected function createParentTable($conn, $parentTableName);
    public function __construct(){
        echo "createParentTable is running";
    }
}

class MakeNewTable extends MakeTable {
    protected function createParentTable($conn, $parentTableName) {
        $parentTableName = preg_replace('/[^a-zA-Z0-9_]+/', '', $parentTableName); // Ensure table name is safe
        $sql = "CREATE TABLE IF NOT EXISTS $parentTableName (
            user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
            user_name VARCHAR(35) NOT NULL,
            email VARCHAR(50) NOT NULL,
            profile_picture VARCHAR(255) PRIMARY KEY AUTO_INCREMENT NOT NULL
            user_password VARCHAR(35) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }
}

class CascadeTable extends MakeTable {
    protected function createParentTable($conn, $tableName){
        $tableName = preg_replace('/[^a-za-z0-9_]+/', '', $tableName);
        $sql = "CREATE TABLE IF NOT EXISTS $tableName(
        profile_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
        profile_picture VARCHAR(255) NOT NULL,
        user_id INT() NOT NULL
        FOREIGN KEY(user_id) REFERENCES ())";

    }
}


class DisplayMembersConnectionModifiers {
    private $host;
    private $userName; 
    private $password;
    private $database;
    public $conn;
    public $loginUser;
    public function __construct() {
        echo "Welcone Sir.<br>";
        $this->host = "localhost";
        $this->userName = "root";  
        $this->password = "";
        $this->database = "php";
        // Ensure that the session is started before accessing $_SESSION
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Initialize the property inside the constructor
        $this->loginUser = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }
    // Ensure that the PDO connection is correct
    public function connectionPdo() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->userName, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Failed to connect: " . $e->getMessage();
        }
    }
    public function displayLoginUser() { // Function without using any argument
        $this->connectionPdo();
        $query = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $this->loginUser, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function displayAllUser($tableUsers = 'users') { // Function with an argument
        $query = "SELECT * FROM $tableUsers";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function __destruct() {
        return "Thanks for visit.<br>";
        exit();
    }
}
?>
