<h1>hello</h1>
<?php
if(isset($_GET['SubCategoryId'])){
    $SubCategoryId = $_GET['SubCategoryId'];

    $addProduct = new addProduct;
    echo $addProduct->addProductInCart($SubCategoryId);
}else{
    header('Location : index.php');
}
?>