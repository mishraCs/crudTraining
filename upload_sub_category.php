<?php
include 'HtDocs/Views/Frontend/Header.php';
if ($_SESSION['admin_id'] != 1) {
    header('location: login.php');
    exit();
}
if (isset($_POST['submit'])) {
    $newSubCategory = $SubCategoryObj->subCategoryInsert();
    if (isset($newSubCategory)) {
        ?>
        <div class="alert alert-danger form-div" role="alert">
            <?php echo $newSubCategory . "<br>"; ?>
        </div>
        <?php
    }
}
?>
<div class="form_div">
    <h2>Add Subcategory</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label>Select Category</label><br>
        <select name="category_select" required>
            <?php
            $allCategories = $CategoryObj->selectCategory();
            if (is_array($allCategories)) {
                foreach ($allCategories as $category) { ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                <?php }
            } else {
                echo "<option value=''>Error loading categories</option>";
            }
            ?>
        </select><br>
        <label>Subcategory Name</label>
        <input class="form-control" type="text" id="sub_category_name" name="sub_category_name" required><br>
        <label>Subcategory Image</label>
        <input class="form-control" type="file" id="sub_category_image" name="sub_category_image" required><br>
        <label>Subcategory Description</label><br>
        <textarea class="form-control" name="sub_category_description" id="sub_category_text" required></textarea><br>
        <label>Price</label><br>
        <input class="form-control" type="number" name="sub_category_price" required><br>
        <label>Quantity Available</label><br>
        <input class="form-control" type="number" name="sub_category_quantity" required><br>
        <button class="btn btn-primary sumbt" name="submit" type="submit">Submit</button>
    </form>
</div>
<?php include 'HtDocs/Views/Frontend/Footer.php'; ?>
