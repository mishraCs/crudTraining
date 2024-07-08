<h1>hello</h1>
<?php
include 'Controller/add_product.php';
if(isset($_GET['SubCategoryId'])){
    $SubCategoryId = $_GET['SubCategoryId'];
    $addProduct = new addProduct;
    echo $addProduct->addProductInCart($SubCategoryId);
    header('location: home.php');
    echo "<script>window.location('home.php')</script>";
}else{
    header('Location : index.php');
}
?>
