<?php

namespace Controller;

use Controller\CreateConnection;

class User extends CreateConnection {

    public function calculateTotalPages($totalRecords, $limit) {
        return ceil($totalRecords / $limit);
    }

    public function getTotalUserCount() {
        try {
            $this->connectionMysqli();
            $query = "SELECT COUNT(*) as total FROM users";
            $result = $this->conn->query($query);
            if (!$result) {
                throw new \Exception("Query failed: " . mysqli_error($this->conn));
            }
            $total = $result->fetch_assoc()['total'];
            $this->closeConnection();
            return $total;
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getUsers($limit, $startFrom) {
        try {
            $this->connectionMysqli();
            $query = "SELECT * FROM users LIMIT ?, ?";
            $stmt = mysqli_prepare($this->conn, $query);
            if (!$stmt) {
                throw new \Exception("Prepare failed: " . mysqli_error($this->conn));
            }
            mysqli_stmt_bind_param($stmt, 'ii', $startFrom, $limit);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
    
            // Fetch all users as an array of associative arrays
            $users = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
    
            mysqli_stmt_close($stmt);
            $this->closeConnection();
            return $users;
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function displayLoginUser($userId) {
        try {
            $this->connectionMysqli();             
            $query = "SELECT * FROM users WHERE user_id = ?";
            $stmt = mysqli_prepare($this->conn, $query);
            
            if (!$stmt) {
                throw new \Exception("Prepare failed: " . mysqli_error($this->conn));
            }

            mysqli_stmt_bind_param($stmt, 'i', $userId);
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            
            mysqli_stmt_close($stmt);
            $this->closeConnection(); 
            return $row;
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function user_delete() {
        try {
            $this->connectionMysqli();             
            $userId = $_GET['user_id'];
            $sql = "SELECT *FROM user_profile WHERE user_id = '$userId'";
            $stmt = mysqli_prepare($this->conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $profileImage = $row['profile_image'];
                if (file_exists($profileImage)) {
                    unlink($profileImage);
                }
            }
            $sql = "SELECT profile_image FROM users WHERE user_id = '$userId'";
            $stmt = mysqli_prepare($this->conn, $sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $profileImage = $row['profile_image'];
                if (file_exists($profileImage)) {
                    unlink($profileImage);
                }
            }
            $query = "DELETE FROM users WHERE user_id = '$userId'";
            if ($this->conn->query($query)) {
                echo "Profile permanently deleted";
                return header('Location: home.php');
            } else {
                die('Something went wrong');
            }
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function user_file($userId) {
        try {
            $this->connectionMysqli();
            $query = "SELECT * FROM user_profile WHERE user_id= ?";
            $stmt = mysqli_prepare($this->conn, $query);
            if (!$stmt) {
                throw new \Exception("Prepare failed: " . mysqli_error($this->conn));
            }
            mysqli_stmt_bind_param($stmt, 'i', $userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $files = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $files[] = $row;
            }
            mysqli_stmt_close($stmt);
            $this->closeConnection();
            return $files;
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function name_file($user_id, $userFile) {
        if(isset($_POST['submit'])){
            $this->connectionMysqli();
            try {
                $uploadedFiles = [];
                foreach ($userFile['name'] as $key => $name) {
                    if ($userFile['error'][$key] === 0) {
                        $tmpName = $userFile['tmp_name'][$key];
                        $fileExtension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                        if ($fileExtension === 'jpg' || $fileExtension === 'jpeg' || $fileExtension === 'png' || $fileExtension === 'avif') {
                            $fileName = time() . '_' . basename($name);
                            $uploadDir = 'uploads/' . $fileName;
                            if (move_uploaded_file($tmpName, $uploadDir)) {
                                $uploadedFiles[] = $uploadDir;
                            } else {
                                echo "Error moving file $fileName<br>";
                            }
                        } else {
                            echo "Only JPEG and PNG files are allowed. File '$name' has an invalid extension.<br>";
                        }
                    } else {
                        echo "Error uploading file $name<br>";
                    }
                }
        
                if (!empty($uploadedFiles)) {
                    $filePaths = implode(',', $uploadedFiles);
                    try {
                        $stmt = $this->conn->prepare("INSERT INTO user_profile (profile_image, user_id) VALUES (?, ?)");
                        $stmt->bind_param("si", $filePaths, $user_id);
                        if ($stmt->execute()) {
                            return "Files uploaded successfully<br>";
                        } else {
                            echo "Error uploading files: " . $stmt->error . "<br>";
                        }
                        $stmt->close();
                    } catch (\Throwable $th) {
                        echo $th->getMessage();
                    }
                }
                } catch (\Throwable $th) {
                    //throw $th;
                }
        }
        return "File upload complete";
        ;
    }

    public function verify_email() {
        try {
            $active = $_GET['active'];
            $email = $_GET['email'];
            $this->connectionMysqli();
            $sql = "SELECT * FROM users WHERE active = ? AND email = ?";
            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $active, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $_SESSION['user_id'] = $user['user_id'];
                if ($user['user_admin'] == 1) { 
                    $_SESSION['admin_id'] = $user['user_admin'];
                    $_SESSION['first_name'] = $user['first_name'];
                }
                header('Location: index.php');
                exit();
            }
        } catch (\Exception $e) {
            return "Try again!!: " . $e->getMessage();
        }
        return 'There is a verification issue';
    }

    function smtp_mailer($to, $subject, $msg) {
        $mail = new \PHPMailer(); 
        $mail->IsSMTP(); 
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; 
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        //$mail->SMTPDebug = 2; 
        $mail->Username = "aakashthink0096@gmail.com";
        $mail->Password = "zkvn fwqz hffn kleo";
        $mail->SetFrom("aakashthink0096@gmail.com");
        $mail->Subject = $subject;
        $mail->Body = $msg;
        $mail->AddAddress($to);
        $mail->SMTPOptions = array('ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => false
        ));
        if (!$mail->Send()) {
            echo $mail->ErrorInfo;
        } else {
            return '<br>';
        }
    }

    public function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $otp = rand(111111, 666666);
        $this->connectionMysqli();
        $sql = "UPDATE users SET active = ? WHERE email = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $otp, $email);
        mysqli_stmt_execute($stmt);
        $sql1 = "SELECT * FROM users WHERE email = ?";
        $stmt1 = mysqli_prepare($this->conn, $sql1);
        mysqli_stmt_bind_param($stmt1, "s", $email);
        mysqli_stmt_execute($stmt1);
        $result = mysqli_stmt_get_result($stmt1);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['user_password'])) {
                require_once('./phpmailersmtp/smtp/PHPMailerAutoload.php');
                $message = "Please click on this URL to sign in to your website: http://localhost/MyCode/CRUD/login.php?email=" . $email . "&active=" . $otp;
                $to = $email;
                $phpMailer = $this->smtp_mailer($email, 'Subject', $message);
                echo $phpMailer;
                return 'Click the link sent to your registered email.';
            } else {
                return "Invalid password.";
            }
        } else {
            return "No user found with this email.";
        }
    }

    public function checkUser($email) {
        $result = false;
        try {
            $this->connectionMysqli();
            $sql = "SELECT COUNT(*) FROM users WHERE email = ?"; 
            $stmt = $this->conn->prepare($sql);  
            if (!$stmt) {
                throw new \Exception("Prepare failed: " . $this->conn->error); 
            }
            $stmt->bind_param('s', $email);
            $stmt->execute();  
            $stmt->bind_result($count);
            $stmt->fetch();
        
            $result = $count > 0;
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage(); 
        }
        return $result;
    }
    
    public function register_user() {
        $message = '';
        try {
            $this->connectionMysqli();
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            if ($password !== $confirm_password) {
                $message = "Passwords do not match.";
                return $message;
            }
            $userExists = $this->checkUser($email); 
            if ($userExists === true) {
                $message = "User already exists, please use another email.";
                return $message;
            }
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $target_dir = "uploads/";
            $file = $_FILES["profile_image"];
            $target_file = $target_dir . basename($file["name"]);
            $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if (!in_array($fileExtension, ['jpg', 'jpeg', 'png', 'avif'])) {
                $message = "Only JPEG, PNG, and AVIF files are allowed.";
                return $message;
            }
            if (!move_uploaded_file($file["tmp_name"], $target_file)) {
                $message = "Failed to upload file.";
                return $message;
            }
            $stmt = $this->conn->prepare("INSERT INTO users (first_name, last_name, email, user_password, profile_image) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                $message = "Prepare failed: " . $this->conn->error;
                return $message;
            }
            $stmt->bind_param("sssss", $first_name, $last_name, $email, $hashed_password, $target_file);
        
            if ($stmt->execute()) {
                header('Location: login.php');
                exit();
            } else {
                $message = "Error: " . $stmt->error;
                return $message;
            }
        } catch (\Throwable $th) {
            $message = "An error occurred: " . $th->getMessage();
            return $message;
        } finally {
            if (isset($stmt)) {
                $stmt->close(); 
            }
            $this->closeConnection(); 
        }
    }
    
}
?>
