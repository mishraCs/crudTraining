<?php
include 'CreateConnection.php';
class addProduct extends CreateConnection{
    public function addProductInCart($SubCategoryId, $UserId){
        $sql = "INSERT INTO cart (user_id, sub_category_id) VALUES ($SubCategoryId)";
        try {
            $this->conn->query($sql);
            return "Thank you" .$_SESSION['login_user'] ."<br>Product add successfully";
        } catch (\Throwable $th) {
            return $th->getmessage();
        }
    }
}
?>