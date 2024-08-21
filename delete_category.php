<?php
include 'HtDocs/Views/Frontend/Header.php';
if (isset($_POST['submit'])) {
    $categoryAction = $CategoryObj->deleteCategory();
    if (isset($categoryAction)) {
        ?>
        <div class="alert alert-danger form-div" role="alert">
            <?php echo $categoryAction . "<br>"; ?>
        </div>
        <?php
    }
}
$allCategory = $CategoryObj->selectCategory();
?>
<div class="form_div">
    <h2>Delete Category</h2>
    <form class="form-group" action="" method="post" enctype="multipart/form-data">
        <label>Select Category</label><br>
        <select name="category_select">
            <?php 
            if (is_array($allCategory)) {
                foreach ($allCategory as $category) { ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                <?php }
            } else { ?>
                <option value="">Error loading categories</option>
            <?php } ?>
        </select><br>
        <button class="btn btn-primary sumbt" name="submit" type="submit">Submit</button>
    </form>
</div>
<?php include 'HtDocs/Views/Frontend/Footer.php'; ?>
