<?php
ob_start();
class ProfileUser{

    public function sessionFile($conn, $profile_id){
        try {
            $userId = $_SESSION['user_id'];
            $sql = "select *from users where profile_id = '$profile_id'";
            $result = $conn->query($sql);
            if(mysqli_num_rows($result)>0){
                $profileRow = $result->fetch_assoc();
                $userCheck = $profileRow['profile_id'];
                if($profile_id == $userCheck){
                    return "Please add another profile picture before deleted";
                }else{
                 return false;
                }
             }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
    public function chekuser($conn,$email) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result)>0){
            return "Choose another email! <br> This email already exist";
        }
    }
    public function current_user($conn){
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE user_id='$user_id'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
        return $user;
    }

    public function user_file($conn, $userId){
        $stmt = "SELECT * FROM user_profile WHERE user_id='$userId'";
        $result = $conn->query($stmt);
        return $result;
    }

    public function delete_user_file($conn, $user_id){
        $stmt = "Delete from user_profile where user_id = $user_id";
        $result = $conn->query($stmt);
    }

    public function login_user_profile_picture($conn, $profilePath, $userId){
        $stmt = "SELECT * FROM user_profile WHERE profile_image ='$profilePath'";
        $result = $conn->query($stmt);
        $profileRow = $result->fetch_assoc();
        $profileId = $profileRow['profile_id'];
        if (!empty($profilePath) && !empty($userId)) {
            $stmt = $conn->prepare("UPDATE users SET profile_image = ?, profile_id = ? WHERE user_id = ?");
            $stmt->bind_param("ssi", $profilePath, $profileId, $userId);
            if ($stmt->execute()){
                $_SESSION['profile_image'] = $profilePath;
                header('Location: dashboard.php');
                return "profile updated";
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        $stmt->close();
        }
    }

    public function update_profile_picture($conn, $profilePath, $userId){
        $stmt = "SELECT * FROM user_profile WHERE profile_image ='$profilePath'";
        $result = $conn->query($stmt);
        $profileRow = $result->fetch_assoc();
        $profileId = $profileRow['profile_id'];
        if (!empty($profilePath) && !empty($userId)) {
            $stmt = $conn->prepare("UPDATE users SET profile_image = ?, profile_id = ? WHERE user_id = ?");
            $stmt->bind_param("ssi", $profilePath, $profileId, $userId);
            if ($stmt->execute()){
                header('Location:view.php');
                return "profile updated";
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }
        $stmt->close();
        }
    }
}

class VerifyUser {

  public function verify_email($conn){
    $active = $_GET['active'];
    $email = $_GET['email'];
    $sql = "SELECT * FROM users WHERE active = '$active' AND email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        if($user['user_admin'] = 1){
         $_SESSION['admin_id'] = $user['user_admin'];
        }
        header('Location: dashboard.php');
        return 'I can not redirect';
    }else{
       return 'Try again!!';
    }
    return 'There is verify issue';
  }

  public function login($conn){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $otp = rand(111111, 666666);
    $sql = "UPDATE users SET active = '$otp' WHERE email = '$email'";
    $result1 = $conn->query($sql);
    $sql1 = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql1);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['user_password'])) {
            include('./phpmailer_smtp/smtp/PHPMailerAutoload.php');
            $message =  "Please click on this url to sign in to you this your own webseit http://localhost/MyCode/CRUD/login.php?email=".$email."&active=".$otp;
            $to = $email;
            function smtp_mailer($to,$subject, $msg){
                $mail = new PHPMailer(); 
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
                $mail->Body =$msg;
                $mail->AddAddress($to);
                $mail->SMTPOptions=array('ssl'=>array(
                    'verify_peer'=>false,
                    'verify_peer_name'=>false,
                    'allow_self_signed'=>false
                ));
                if(!$mail->Send()){
                    echo $mail->ErrorInfo;
                }else{
                    return '<br>';
                }
            }
            echo smtp_mailer($email,'Subject',$message);
            return 'click link! send on your registered email ';
        } else {
            return "Invalid password.";
        }
    } else {
        return "No user found with this email.";
    }
  }
}

class AddUser{
    public function register_user($conn){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $profile = new ProfileUser;
        $data = $profile->chekuser($conn,$email);
        if($data){
            return $data;
        }
        $password = $_POST['password'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $target_dir = "uploads/";
        $name = $_FILES["profile_image"];
        $target_file = $target_dir . basename($name["name"]);
        $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($fileExtension === 'jpg' || $fileExtension === 'jpeg' || $fileExtension === 'png') {
            move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
            $sql = "INSERT INTO users (first_name, last_name, email, user_password, profile_image) VALUES ('$first_name', '$last_name', '$email', '$password', '$target_file')";
            if ($conn->query($sql) === TRUE) {
                header('Location: login.php');
            } else {
                return "Error: " . $sql . "<br>" . $conn->error;
            }
        }else{
            return "Only JPEG and PNG files are allowed. File '$target_file' has an invalid extension.<br>";
        }
        
    }
}

class UpdataLoginUser{
    public function select_user($conn, $user_id){
        $sql = "SELECT * FROM users WHERE user_id=$user_id";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
        return $user;
    }

    public function update_info_user($conn, $user_id){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        if (!empty($_FILES["profile_image"]["name"])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
            $fileExtension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            try {
                //code...
                if($fileExtension == 'jpeg' || $fileExtension == 'jpg' || $fileExtension == 'avif'){
                    move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
                    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', profile_image='$target_file' WHERE user_id='$user_id'";
                }else{
                    return "Only JPEG and PNG files are allowed. File '$target_file' has an invalid extension.<br>";
                }
            } catch (\Throwable $th) {
                //throw $th;
                echo $th->getmessage();
            }
        } else {
            $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name' WHERE user_id='$user_id'";
        }
        if ($conn->query($sql) === TRUE) {
            header('Location: home.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

class DeleteUser{
    public function user_delete($conn) {
        $userId = $_GET['user_id'];
        $sql = "SELECT *FROM user_profile WHERE user_id = '$userId'";//user_profile
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $profileImage = $row['profile_image'];
            if (file_exists($profileImage)) {
                unlink($profileImage);
            }
        }
        $sql = "SELECT profile_image FROM users WHERE user_id = '$userId'";// users
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $profileImage = $row['profile_image'];
            if (file_exists($profileImage)) {
                unlink($profileImage);
            }
        }
        $query = "DELETE FROM users WHERE user_id = '$userId'";
        if ($conn->query($query)) {
            echo "Profile permanently deleted";
            return header('Location: home.php');
        } else {
            die('Something went wrong');
        }
    }
}

class InsertMultipleImage {
    public function name_file($conn, $user_id, $userFile) {
        if(isset($_POST['submit'])){
            foreach ($userFile['name'] as $key => $name) {
                if ($userFile['error'][$key] === 0) {
                    $tmpName = $userFile['tmp_name'][$key];
                    $fileExtension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                    if ($fileExtension === 'jpg' || $fileExtension === 'jpeg' || $fileExtension === 'png') {
                        $fileName = time() . '_' . basename($name);
                        $uploadDir = 'uploads/' . $fileName;
                        if (move_uploaded_file($tmpName, $uploadDir)) {
                            try {
                                //code...
                                $stmt = $conn->prepare("INSERT INTO user_profile (profile_image, user_id) VALUES (?, ?)");
                                $stmt->bind_param("si", $uploadDir, $user_id);
                                if ($stmt->execute()) {
                                    echo $fileName . " uploaded successfully<br>";
                                } else {
                                    echo "Error uploading file $fileName: " . $stmt->error . "<br>";
                                }
                                $stmt->close();
                            } catch (\Throwable $th) {
                                echo $th->getMessage();
                            }
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
        }
        return "File upload complete";
    }
}




