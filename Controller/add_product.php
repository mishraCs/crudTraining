<?php
include 'CreateConnection.php';
include 'helper/header.php';

class addProduct extends CreateConnection { //add_product.php
    public function addProductInCart  ($SubCategoryId){
        $sql = "SELECT * FROM cart WHERE sub_category_id = $SubCategoryId";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            echo "<script type='text/javascript'>
                        $(document).ready(function(){
                            $('#addToCart').modal('show');
                            setTimeout(function (){
                                $('#addToCart').modal('hide');
                            }, 5000);
                        });
                 </script>";
        }else{
            $userId = $_SESSION['user_id'];
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
}
?>
<!-- Modal logout -->
<div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Wow!! You are already add this product in your cart.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a type="button" class="btn btn-primary" href="logout.php" >Yes</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal logout -->

