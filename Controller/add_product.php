<?php
include 'CreateConnection.php';
include 'helper/header.php';

class addProduct extends CreateConnection { //add_product.php
    public function addProductInCart  ($SubCategoryId){
        $userId = $_SESSION['user_id'];
        // echo $userId;exit();
        $sql = "INSERT INTO cart (user_id, sub_category_id) VALUES ($userId, $SubCategoryId)";
        try {
            $this->conn->query($sql);
            return "Thank you"."<br>Product add successfully";
            header('Location: home.php');
        } catch (\Throwable $th) {
            return $th->getmessage();
        }
    }
}
?>