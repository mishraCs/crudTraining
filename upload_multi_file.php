<?php
 include 'header.php';
 include 'db.php';
if (!isset($_GET['user_id'])) {
    header('Location: login.php');
    exit();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_FILES['profile_image'])){
        $user_file = $_FILES['profile_image'];
        $upload_file = new insert_multiple_file;
        echo $upload_file->name_file();
    }
}


?>
<div class="form_div col-md-4">
    <h2>uplad multiple file</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label for="first_name">File</label>
        <input class="form-control" type="file" id="file" name="profile_image[]" multiple required >
        <button class="btn btn-success" name="submit" type="submit">Submit</button>
    </form>
</div>