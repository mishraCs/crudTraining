<?php
include 'helper/header.php';
if (!empty($_GET['subCategoryId'])) {
   $data = new Subcategory;
    $subCategory = $data->subCategoryView();
}
?>
<div style="display:flex">
    <div class=" user_info container">
        <div class=" img_user_info col-md-5">
           <img class="categorry_view_img" src="<?php echo $subCategory['sub_category_image'] ?>" alt="Category Image">
           <div class="col_div">
            <?php
            $subCategoryId = $subCategory['sub_category_id'];
            $userId = $_SESSION['user_id'];
             $sql ="SELECT * FROM cart WHERE sub_category_id = $subCategoryId AND user_id = $userId";
             $result = mysqli_query($conn, $sql);
             if($result->num_rows >0 ){
                echo '<button onclick="window.location.href=\'add_to_cart.php?SubCategoryId=' . $subCategoryId . '\'" class="btn btn-success">Remove from cart</button>';

                
             }else{
                echo "<button onclick='window.location.href=add_to_cart.php?SubCategoryId=<?php echo $subCategoryId; ?>' class='btn btn-success'>Add to cart</button>" ;
             }
            ?>
           <button class='btn btn-danger'>Buy Now</button>
           </div>
        </div>
        <div class="category_card col-md-6 ml-0 mr-0">
          <h4>Name: <b><?php echo $subCategory['sub_category_name'] ?></b></h4>
          <h4>Price: <b><?php echo $subCategory['sub_category_price'] ?></b></h4>
          <h4>Quantity: <b><?php echo $subCategory['sub_category_quantity'] ?></b></h4>

          <p class="card_content"><?php echo $subCategory['sub_category_description'] ?></p>
        </div>
    </div>
</div>





