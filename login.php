<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
include 'HtDocs/Views/Frontend/Header.php';
if (isset($_SESSION['user_id'])) {
    header('Location: Index.php');
    exit();
}
if(isset($_GET['email']) && isset($_GET['active'])){
    $result = $User->verify_email();
    if(isset($result)){
        ?> <div class="alert alert-danger" role="alert">
        <?php echo $result."<br>"; ?>
      </div> <?php
    }
}
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
   $result =  $User->login();
   if(isset($result)){
        ?> <div class="alert alert-danger" role="alert">
        <?php echo $result."<br>"; ?>
    </div> <?php
    }
}
?>
<div class="form_div">
    <h3>Login Form  :</h3>
    <p>Please Login using the link shared on your Email.</p>
    <form class="form-group" method="post" name="usrForm" id="UserForm">
        <label for="email">Email:</label>
        <input type="email" class="form-control"  id="email" name="email" required><br>
        <label for="password">Password:</label>
        <p>Please input your last correct password</p>
        <input type="password" class="form-control"  id="password" name="password" required>
        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span><br>
    </form>
    <button class="btn btn-primary sumbt" form="UserForm" name="submit" type="submit">Login</button>
</div>
<?php include 'HtDocs/Views/Frontend/Footer.php'; ?>
 <script type="module">
    $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
    input.attr("type", "text");
    } else {
    input.attr("type", "password");
    }
    });
</script>
