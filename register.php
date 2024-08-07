<?php

include 'helper/header.php'; 
if (isset($_POST['submit'])) {
    $register = new AddUser;
    $registerMessage = $register->register_user($conn);
    if(isset($registerMessage)){
        ?> <div class="alert alert-danger" role="alert">
        <?php echo $registerMessage."<br>"; ?>
      </div><?php
    }
}?>
<link rel="stylesheet" href="./css/style.css">
<div class=" header_nav form_div">
    <h3>Register Form</h3>
    <form class="form-group" method="post" name="myForm" onsubmit=" return validateform()" enctype="multipart/form-data">
        <div id = "name" ><label>First Name:</label><br><span class="form_error"></span>
        <input class="form-control" type="text" id="first_name" name="first_name" value=""  required ><br></div>

        <div id = "last_name" ><label for="last_name">Last Name:</label><br><span class="form_error"></span>
        <input class="form-control" type="text" id="last_name" name="last_name" required ><br></div>

        <div id = "email"><label>Email:</label><br><span class="form_error"></span>
        <input class="form-control" type="email" id="email" name="email" required ><br></div>
        
        <div id = "password_error"><label>Password:</label><br><span class="form_error"></span>
        <input id="password" type="password" class="form-control" name="password" value="" required>
        <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span><br></div>

        <div id="confirm_password_error"><label>Confirm Password:</label><br><span class="form_error"></span>
        <input id="confirm_password" type="password" class="form-control" name="confirm_password" value="" required>
        <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span><br></div>
        
        <div id = "profile_image" ><label>Profile Image:</label><br><span class="form_error"></span>

        <input class="form-control" type="file" id="profile_image" name="profile_image"  required><br></div>
        <button class="btn btn-primary sumbt" name="submit" type="submit">Register</button>
    </form>
</div>
<?php include 'helper/footer.php'; ?>

<script type="module"> //password input 
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
<script src="./js/script.js"></script> 

