<?php
include 'helper/header.php';

if ($_SESSION['admin_id'] != 1) {
    header('location: login.php');
    exit();
}

if (isset($_POST['submit'])){
    $data = new CategoryInsert;
    $data = $data->uploadCategory();
    if(isset($data)){
        ?><div class="alert alert-danger form-div" role="alert">
        <?php echo $data."<br>"; ?>
        </div> <?php
    }
}
?>

<div class="form_div">
    <h2>Add Category</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label>Category Name</label>
        <input class="form-control" type="text" id="category_name" name="category_name" required><br>
        <label>Category Image</label>
        <input class="form-control" type="file" id="category_image" name="category_image" required><br>
        <label>Description</label><br>
        <textarea class="form-control" name="category_description" id="category_text"></textarea><br>
        <button class="btn btn-primary sumbt" name="submit" type="submit">Submit</button>
    </form>
</div>
