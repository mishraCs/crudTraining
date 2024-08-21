<?php
Include 'HtDocs/Views/Frontend/Header.php';
if (!isset($_GET['user_id'])) {
    header('Location: login.php');
    exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_FILES['profile_image'])){
        $userFile = $_FILES['profile_image'];
        $user_id = $_GET['user_id'];
        $message =  $User->name_file($user_id, $userFile);
        if(isset($message)){
            ?> <div class="alert alert-danger" role="alert">
            <?php echo $message."<br>"; ?>
          </div> <?php
        }
    }else{
        echo "Error in running function";
    }
}?>
<div class="form_div">
    <h2>Upload Profile Image Only</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label for="first_name">File</label>
        <input class="form-control" type="file" id="file" name="profile_image[]" multiple required >
        <button class="btn btn-success" name="submit" type="submit">Submit</button>
    </form>
</div>