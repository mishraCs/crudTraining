<?php
class profile_user{

    public function current_user($conn){
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM users WHERE user_id='$user_id'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
        return $user;
    }
}

class verify_user {

  public function verify_email($conn){
    $active = $_GET['active'];
    $email = $_GET['email'];
    $sql = "SELECT * FROM users WHERE active = '$active' AND email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['user_id'];
        header('Location: dashboard.php');
        die('I can not redirect');
    }else{
        die('Try again!!');
    }
    die('There is verify issue');
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
                    return 'Sent<br>';
                }
            }
            echo smtp_mailer($email,'Subject',$message);
            die('click link! send on your registered email ');
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }
  }
}


class add_user{
    public function register_user($conn){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);

        $sql = "INSERT INTO users (first_name, last_name, email, user_password, profile_image) VALUES ('$first_name', '$last_name', '$email', '$password', '$target_file')";
        if ($conn->query($sql) === TRUE) {
            header('Location: login.php');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

class update_login_user{
    public function select_user($conn, $user_id){
        $sql = "SELECT * FROM users WHERE user_id='$user_id'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
        return $user;
    }

    public function update_info_user($conn, $user_id){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
            if (!empty($_FILES["profile_image"]["name"])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
                move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);
                $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', profile_image='$target_file' WHERE user_id='$user_id'";
            } else {
                $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email' WHERE user_id='$user_id'";
            }
                if ($conn->query($sql) === TRUE) {
                    header('Location: home.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
    }
}

class delete_user{
    public function user_delete($conn){
        $user_id = $_GET['user_id'];
        $query = "delete from users where user_id = '$user_id'";
        if(mysqli_query($conn, $query)){
            echo  "Profile permanently deleted";
            return header('Location: home.php');
        }else{
            die('something went wrong');
        }
    }
}

class insert_multiple_file {
    public function name_file($conn, $user_id, $userFile) {
        if(isset($_POST['submit'])){
            foreach($userFile['name'] as $key => $name){
                if($userFile['error'][$key] === 0){
                    $tmpName = $userFile['tmp_name'][$key];
                    $fileName = time() . '_' . basename($name); 
                    $upload_dir = 'uploads/' . $fileName;
                    if(move_uploaded_file($tmpName, $upload_dir)){
                        $stmt = $conn->prepare("INSERT INTO user_profile (profile_image, user_id) VALUES (?, ?)");
                        $stmt->bind_param("si", $fileName, $user_id);
                        if($stmt->execute()){
                            echo $fileName . " uploaded successfully<br>";
                        } else {
                            echo "Error uploading file $fileName : " . $stmt->error . "<br>";
                        }
                        $stmt->close();
                    } else {
                        echo "Error moving file $fileName<br>";
                    }
                } else {
                    echo "Error uploading file $fileName<br>";
                }
            }
        }
        return "File upload complete";
    }
}




