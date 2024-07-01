<?php
include 'helper/header.php';

if ($_SESSION['admin_id'] != 1) {
    header('location: login.php');
    exit();
}

if (isset($_POST['submit'])){
    $categoryName = htmlspecialchars($_POST['category_name']);
    $categoryImage = $_FILES['category_image'];
    $categoryDescription = htmlspecialchars($_POST['category_description']);

    if (!empty($categoryImage['name'])) {
        $categoryDirectory = "category/";
        $categoryPathName = $categoryDirectory . basename($categoryImage['name']);
        $fileExtension = strtolower(pathinfo($categoryPathName, PATHINFO_EXTENSION));
        try {
            if (in_array($fileExtension, ['jpeg', 'jpg', 'avif', 'png'])) {
                if (move_uploaded_file($categoryImage['tmp_name'], $categoryPathName)) {
                    // Assuming $conn is your mysqli connection object
                    $sql = "INSERT INTO category (category_name, category_image, category_description) VALUES ('$categoryName', '$categoryPathName', '$categoryDescription')";
                    $conn->query($sql);
                    echo "Category added successfully.";
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
    <h2>Add Category</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label>Category Name</label>
        <input class="form-control" type="text" id="category_name" name="category_name" required><br>
        <label>Category Image</label>
        <input class="form-control" type="file" id="category_image" name="category_image" required><br>
        <label>Description</label><br>
        <textarea class="form-control" name="category_description" id="category_text"></textarea><br>
        <button class="btn btn-success" name="submit" type="submit">Submit</button>
    </form>
</div>
