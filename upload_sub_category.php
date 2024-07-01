<?php
include 'helper/header.php';

if ($_SESSION['admin_id'] != 1) {
    header('location: login.php');
    exit();
}

if (isset($_POST['submit'])){
    $sub_categoryName = htmlspecialchars($_POST['sub_category_name']);
    $sub_categoryImage = $_FILES['sub_category_image'];
    $sub_categoryDescription = htmlspecialchars($_POST['sub_category_description']);
    $category_select = $_POST['category_select'];
    if (!empty($sub_categoryImage['name'])) {
        $sub_categoryDirectory = "category/";
        $sub_categoryPathName = $sub_categoryDirectory . basename($sub_categoryImage['name']);
        $fileExtension = strtolower(pathinfo($sub_categoryPathName, PATHINFO_EXTENSION));
        try {
            if (in_array($fileExtension, ['jpeg', 'jpg', 'avif', 'png'])) {
                if (move_uploaded_file($sub_categoryImage['tmp_name'], $sub_categoryPathName)) {
                    $sql = "INSERT INTO sub_category (sub_category_name, sub_category_image, category_id, sub_category_description) VALUES ('$sub_categoryName', '$sub_categoryPathName', $category_select, '$sub_categoryDescription')";
                    $conn->query($sql);
                    echo "sub_Category added successfully.";
                } else {
                    echo "Failed to upload image.";
                }
            } else {
                echo "Invalid file type. Only JPEG, JPG, AVIF, and PNG are allowed.";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please upload an image.";
    }
}
?>
<div class="form_div col-md-4">
    <h2>Add Subcategory</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label>Select Category</label><br>
        <select name="category_select">
            <?php $sql = "SELECT *FROM category";
            $result = $conn->query($sql);
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
