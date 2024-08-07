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
<div class="form_div">
    <h2>Add Subcategory</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label>Select Category</label><br>
        <select name="category_select">
            <?php $data = new ThingsCategory;
            echo $data->text();
                $result = $data->selectCategrory();
            while($category = $result->fetch_assoc()){?><br>
            <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
            <?php }?>
        </select><br>
        <label>Subcategory Name</label>
        <input class="form-control" type="text" id="sub_category_name" name="sub_category_name" required><br>
        <label>Subcategory Image</label>
        <input class="form-control" type="file" id="sub_category_image" name="sub_category_image" required><br>
        <label>Subcategory Description</label><br>
        <textarea class="form-control" name="sub_category_description" id="sub_category_text"></textarea><br>
        <label>Price</label><br>
        <input class="form-control" type="number" name ="sub_category_price"><br>
        <label>Quantity Available</label><br>
        <input class="form-control" type="number" name="sub_category_quantity"><br>
        <button class="btn btn-primary sumbt" name="submit" type="submit">Submit</button>
    </form>
</div>
<?php include 'helper/footer.php'; ?>
