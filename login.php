<?php
ob_start();
include 'helper/header.php'; 
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}
$login = new VerifyUser;
if(isset($_GET['email']) && isset($_GET['active'])){
    $result = $login->verify_email($conn);
    if(isset($result)){
        ?> <div class="alert alert-danger" role="alert">
        <?php echo $result."<br>"; ?>
      </div> <?php
    }
}
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
   $result =  $login->login($conn);
   if(isset($result)){
        ?> <div class="alert alert-danger" role="alert">
        <?php echo $result."<br>"; ?>
    </div> <?php
    }
}
?>
<div class=" form_div ">
    <h2>Login Form</h2>
    <form class="form-group" method="post" name="usrForm" id="UserForm">
        <label for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email" required><br>
        <label for="password">Password:</label>
        <input class="form-control" type="password" id="password" name="password" required><br>
    </form>
    <button class="btn btn-primary" form="UserForm" name="submit" type="submit">Login</button>
</div>
 <?php include 'helper/footer.php';?>

