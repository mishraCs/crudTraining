<?php
namespace Controller;

use Controller\CreateConnection;

class UserUpdate extends CreateConnection {

    public function update_info_user($user_id) {
        die("update_info_");
        $first_name = $_POST['first_name'] ?? '';
        $last_name = $_POST['last_name'] ?? '';
        $target_file = null;
        if (!empty($_FILES["profile_image"]["name"])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
            $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (!in_array($fileExtension, ['jpeg', 'jpg', 'avif'])) {
                return "Only JPEG, JPG, and AVIF files are allowed. File '$target_file' has an invalid extension.<br>";
            }
            if (!move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                return "There was an error uploading the file.<br>";
            }
        }
        try {
            $this->connectionMysqli(); 
            if ($target_file) {
                $sql = "UPDATE users SET first_name = ?, last_name = ?, profile_image = ? WHERE user_id = ?";
                $stmt = mysqli_prepare($this->conn, $sql);
                
                if (!$stmt) {
                    throw new \Exception("Prepare failed: " . mysqli_error($this->conn));
                }

                mysqli_stmt_bind_param($stmt, 'sssi', $first_name, $last_name, $target_file, $user_id);
            } else {
                $sql = "UPDATE users SET first_name = ?, last_name = ? WHERE user_id = ?";
                $stmt = mysqli_prepare($this->conn, $sql);
                if (!$stmt) {
                    throw new \Exception("Prepare failed: " . mysqli_error($this->conn));
                }
                mysqli_stmt_bind_param($stmt, 'ssi', $first_name, $last_name, $user_id);
            }
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                $this->closeConnection(); 
                header('Location: home.php');
                exit();
            } else {
                throw new \Exception("Execution failed: " . mysqli_stmt_error($stmt));
            }
        } catch (\Throwable $th) {
            if (isset($stmt)) {
                mysqli_stmt_close($stmt);
            }
            $this->closeConnection(); 
            return "An error occurred: " . $th->getMessage();
        }
    }
}
?>
