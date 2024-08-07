<?php 
abstract class MakeTable {
    abstract public function createParentTable($conn, $parentTableName);
    abstract public function createChildTable($conn, $tableName, $referenceTable); // cant use private access modifier
    public function __construct() {
        echo "Createation ParentTable is running";
    }
}

class MakeNewTable extends MakeTable {
    public function createParentTable($conn, $parentTableName) {
        $parentTableName = preg_replace('/[^a-zA-Z0-9_]+/', '', $parentTableName); // Ensure table name is safe
        $sql = "CREATE TABLE IF NOT EXISTS $parentTableName (
            user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
            user_name VARCHAR(35) NOT NULL,
            email VARCHAR(50) NOT NULL,
            profile_picture VARCHAR(255) NOT NULL,
            user_password VARCHAR(35) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        return $result;
    }

    public function createChildTable($conn, $tableName, $referenceTable) {
        echo "I have to use these function because this is in abstract class";
    }
}

class CascadeTable extends MakeTable {
    public function createParentTable($conn, $parentTableName) {
        echo "I have to use these function because this is in abstract class";
    }

    public function createChildTable($conn, $tableName, $referenceTable) {
        $tableName = preg_replace('/[^a-zA-Z0-9_]+/', '', $tableName);
        $sql = "CREATE TABLE IF NOT EXISTS $tableName (
            profile_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
            profile_picture VARCHAR(255) NOT NULL,
            user_id INT NOT NULL,
            FOREIGN KEY(user_id) REFERENCES $referenceTable(user_id) ON DELETE CASCADE
        )";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        return $result;
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
class DeCategory extends CreateConnection {
    public function deleteCategory(){
        $categoryId = $_POST['category_select'];
       echo  $sql = "DELETE FROM category WHERE category_id = $categoryId"; 
        $this->conn->query($sql);
        header('Location:home.php?successfullydelete');
    }
}
interface category{
  public function selectCategrory();
}
class ThingsCategory extends CreateConnection {
    public function text(){
        return "hello";
    }
    public function selectCategrory(){
        try {
            $sql = "SELECT * FROM category";
            $result = $this->conn->query($sql);
            return $result;
        } catch (\Throwable $th) {
            return $th->getmessage();
        }
    }
}
class Subcategory extends CreateConnection {
    public function subCategoryView(){
        $subCategoryId = $_GET['subCategoryId'];
        try {
            $sql = "SELECT *FROM sub_category WHERE sub_category_id = $subCategoryId";
            $result = $this->conn->query($sql);
            if ($result) {
                $subCategory = mysqli_fetch_assoc($result);
                return $subCategory;
            } else {
                return "Error executing the query: " . mysqli_error($conn);
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
class UploadSubCategory extends CreateConnection{
    public static function subCategoryInsert($conn){ // here pass argument $conn beacuse it can't access $this that is a object
        $sub_categoryName = htmlspecialchars($_POST['sub_category_name']);
        $sub_categoryImage = $_FILES['sub_category_image'];
        $sub_category_price = $_POST['sub_category_price'];
        $sub_category_quantity = $_POST['sub_category_quantity'];
        $sub_categoryDescription = htmlspecialchars($_POST['sub_category_description']);
        $category_select = $_POST['category_select'];
        if (!empty($sub_categoryImage['name'])) {
            $sub_categoryDirectory = "category/";
            $sub_categoryPathName = $sub_categoryDirectory . basename($sub_categoryImage['name']);
            $fileExtension = strtolower(pathinfo($sub_categoryPathName, PATHINFO_EXTENSION));
            try {
                if (in_array($fileExtension, ['jpeg', 'jpg', 'avif', 'png', 'webp'])) {
                    if (move_uploaded_file($sub_categoryImage['tmp_name'], $sub_categoryPathName)) {
                        $sql = "INSERT INTO sub_category (sub_category_name, sub_category_image, category_id, sub_category_description, sub_category_price, sub_category_quantity) VALUES ('$sub_categoryName', '$sub_categoryPathName', $category_select, '$sub_categoryDescription', '$sub_category_price', '$sub_category_quantity')";
                        $conn->query($sql);
                       return   "sub_Category added successfully.";
                    } else {
                       return   "Failed to upload image.";
                    }
                } else {
                   return   "Invalid file type. Only JPEG, JPG, AVIF, and PNG are allowed.";
                }
            } catch (Exception $e) {
               return   "Error: " . $e->getMessage();
            }
        } else {
               return  "Please upload an image.";
        }
    }
}
Trait Upload{
    public function uploadCategory(){
        $categoryName = htmlspecialchars($_POST['category_name']);
        $categoryImage = $_FILES['category_image'];
        $categoryDescription = htmlspecialchars($_POST['category_description']);
        if (!empty($categoryImage['name'])) {
            $categoryDirectory = "category/";
            $categoryPathName = $categoryDirectory . basename($categoryImage['name']);
            $fileExtension = strtolower(pathinfo($categoryPathName, PATHINFO_EXTENSION));
            try {
                if (in_array($fileExtension, ['jpeg', 'jpg', 'avif', 'png'])) {
                    if (move_uploaded_file($categoryImage['tmp_name'], $categoryPathName)) {
                        $sql = "INSERT INTO category (category_name, category_image, category_description) VALUES ('$categoryName', '$categoryPathName', '$categoryDescription')";
                        $this->conn->query($sql);
                        return "Category added successfully.";
                    } else {
                        return "Failed to upload image.";
                    }
                } else {
                    return "Invalid file type. Only JPEG, JPG, AVIF, and PNG are allowed.";
                }
            } catch (Exception $e) {
                return "Message : " . $e->getMessage();
            }
        } else {
            return "Please upload an image.";
        }
    }
    public function DeleteUserProfile(){
        $stmt = "SELECT * FROM user_profile WHERE profile_id = '$profile_id'";
        $result = $this->conn->query($stmt);
        $row = $result->fetch_assoc();
        if(unlink($row['profile_image'])){
            return "profile deleted";
        }else{
            return 'I cant delete';
        }
        $stmt = "DELETE FROM user_profile WHERE profile_id = '$profile_id' ";
        if(mysqli_query($this->conn, $stmt)){
            return "all related data deleted";
            header('Location: dashboard.php');
        }else{
            return "I can't delete data";
        }
    }
}

class CategoryInsert extends CreateConnection{
    use Upload;
}
?>

