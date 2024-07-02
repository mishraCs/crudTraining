<?php
include 'helper/header.php';
if ($_SESSION['admin_id'] != 1) {
    header('location: login.php');
    exit();
}
if (isset($_POST['submit'])){
     echo  UploadSubCategory::subCategoryInsert($conn);
}
?>
<div class="form_div col-md-4">
    <h2>Add Subcategory</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label>Select Category</label><br>
        <select name="category_select">
            <?php $data = new ThingsCategory;
                $result = $data->selectCategrory();
            while($category = mysqli_fetch_assoc($result)){?><br>
            <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
            <?php }?>
        </select><br>
        <label>Subcategory Name</label>
        <input class="form-control" type="text" id="sub_category_name" name="sub_category_name" required><br>
        <label>Subcategory Image</label>
        <input class="form-control" type="file" id="sub_category_image" name="sub_category_image" required><br>
        <label>Subcategory Description</label><br>
        <textarea class="form-control" name="sub_category_description" id="sub_category_text"></textarea><br>
        <button class="btn btn-success" name="submit" type="submit">Submit</button>
    </form>
</div>
