<?php include 'helper/header.php';
if (!isset($_GET['user_id'])) {
    header('Location: login.php');
    exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_FILES['profile_image'])){
        $userFile = $_FILES['profile_image'];
        $user_id = $_GET['user_id'];
        $upload_file = new InsertMultipleImage;
        echo $upload_file->name_file($conn, $user_id, $userFile);
    }else{
        echo "Error in running function";
    }
}?>
<div class="form_div col-md-4">
    <h2>Upload Profile Image Only</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label for="first_name">File</label>
        <input class="form-control" type="file" id="file" name="profile_image[]" multiple required >
        <!-- <input type="submit" name="submit" value="Submit"> -->
        <button class="btn btn-success" name="submit" type="submit">Submit</button>
    </form>
</div>