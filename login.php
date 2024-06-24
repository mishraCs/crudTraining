<?php

include 'header.php'; 
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}
// include 'class_function.php';
// include 'db.php';
ob_start();
$login = new verify_user;
if(isset($_GET['email']) && isset($_GET['active'])){
    echo $login->verify_email($conn);
    die('Login not complete');
}
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
   echo  $login->login($conn);
}

?>
<div class=" form_div col-md-4">
    <h2>Login Form</h2>
    <form class="form-group" method="post">
        <label for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email" required><br>
        <label for="password">Password:</label>
        <input class="form-control" type="password" id="password" name="password" required><br>
        <button class="btn btn-primary" name="submit" type="submit">Login</button>
    </form>
</div>
 <?php include 'footer.php';?>

