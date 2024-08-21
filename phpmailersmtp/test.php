<?php
include('smtp/PHPMailerAutoload.php');

echo smtp_mailer('to_email','Subject','html');
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
	$mail->Username = "email";
	$mail->Password = "password";
	$mail->SetFrom("email");
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
		return 'Sent';
	}
}
?>


<?php
 include 'header.php'; 
 include 'db.php';
//  if(isset($_SESSION['user_id'])){
//     header('Location: home.php');
//  }
 ?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $otp = rand(111111, 666666);
    // $sql = "SELECT * FROM users WHERE email='$email'";
    $sql = "UPDATE users SET active = '$otp' WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['user_password'])) {
            $_SESSION['user_id'] = $row['id'];
           
            $message = "Please click on this url to sign in to you this your own webseit http://localhost/MyCode/CRUD/login.php?email=".$email."&active=".$otp;

            include('./phpmailer_smtp/smtp/PHPMailerAutoload.php');
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
                    return 'Sent';
                }
            }
            echo smtp_mailer($email,'Subject',$message);









            die('check otp send on your registered email ');
            // header('Location: dashboard.php');
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }
}
?>

<div class=" form_div col-md-4">
    <h2>Login Form</h2>
    <form class="form-group" method="post">
        <label for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email" required><br>
        <label for="password">Password:</label>
        <input class="form-control" type="password" id="password" name="password" required><br>
        <button class="btn btn-primary" type="submit">Login</button>
    </form>
</div>

<?php
 include 'footer.php';

 if(isset($_GET['active'])){
    $otp = $_GET['active'];
    $email = $_GET['email'];

    $sql = "SELECT * FROM users WHERE active = '$otp' AND email = 'email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['user_id'] = $row['id'];
        header('Location: dashboard.php');
        // $row = $result->fetch_assoc();
        die('hello');
    }else{
        die('tyr again');
    }
}
 ?>

