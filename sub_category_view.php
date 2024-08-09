<?php
include 'helper/header.php';
if (!empty($_GET['subCategoryId'])) {
   $data = new Subcategory;
    $subCategory = $data->subCategoryView();
}
?>
<div class="card col-md-3 m-3">
  <div class="card-body text-center">
    <img id="sub_category_id" class="categorry_view_img" src="<?php echo $subCategory['sub_category_image'] ?>" alt="Category Image cpadsfd">
    <button class='btn btn-danger' onclick="buyProduct(<?php echo $subCategory['sub_category_id'] ?>)">Buy Now</button>
    <button onclick="addAsCookie()" class='btn btn-success'>Add to cart</button>
  </div>
  <?php $subCategoryId = $_GET['subCategoryId'];
    $userId = $_SESSION['user_id'];
    $sql ="SELECT * FROM cart WHERE sub_category_id = $subCategoryId AND user_id = $userId";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows >0 ){
    echo '<button onclick="window.location.href=\'add_to_cart.php?SubCategoryId=' . $subCategoryId . '\'" class="btn btn-success">Remove from cart</button>';
    }else{?>
    <h1 style="display:none" id="subCategoryId"><?php echo $subCategoryId ?></h1>
    <?php }
  ?>
  <div class="card-body text-center">
    <h4 class="card-title start-align">Name: <b id="sub_category_name"><?php echo $subCategory['sub_category_name'] ?></b></h4>
    <h4 class="card-title start-align">Price: <b id="sub_category_price"><?php echo $subCategory['sub_category_price'] ?></b></h4>
    <h4 class="card-title start-align">Quantity: <b><?php echo $subCategory['sub_category_quantity'] ?></b></h4>
    <p class="card-text"><?php echo $subCategory['sub_category_description'] ?></p>
  </div>
</div>
<!-- Modal add-pro-cookie -->
<div class="modal fade cart-add-product add-cart-modal" id="successModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">Product add at cart</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">ok</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal add-pro-cookie -->
 <!-- Modal already-add -->
<div class="modal fade cart-add-product add-cart-modal" id="already-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">Product already add in cart</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">ok</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal already-add -->



