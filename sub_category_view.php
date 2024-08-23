<?php
include 'HtDocs/Views/Frontend/Header.php';
if (!empty($_GET['subCategoryId'])) {
    $subCategoryId = $_GET['subCategoryId'];
    $subCategory = $SubCategoryObj->subCategoryView($subCategoryId);
    if ($subCategory) {
        ?>
        <div class="card col-md-3 m-3">
            <div class="card-body text-center">
                <img id="sub_category_img" class="categorry_view_img" src="<?php echo htmlspecialchars($subCategory['sub_category_image']); ?>" alt="Category Image">
                <button class="btn btn-danger" onclick="window.location.href = 'BuyForm.php?subCategoryId=<?php echo $subCategory['sub_category_id']; ?>'">Buy Now</button>
                <button onclick="addAsCookie()" class='btn btn-success'>Add to cart</button>
                <h1 id="subCategoryId" style="display:none"><?php echo $subCategoryId ?></h1>
            </div>
            <?php
            if (isset($_SESSION['user_id'])) {
                $userId = (int)$_SESSION['user_id'];
                
                if ($CartCategory->isSubCategoryInCart($subCategoryId, $userId)) {
                    echo '<button onclick="window.location.href=\'add_to_cart.php?SubCategoryId=' . $subCategoryId . '\'" class="btn btn-success">Remove from cart</button>';
                }
            } else {
                echo '<h1 style="display:none" id="subCategoryId">' . $subCategoryId . '</h1>';
            }
            ?>
            <div class="card-body text-center">
                <h4 class="card-title start-align">Name: <b id="sub_category_name"><?php echo htmlspecialchars($subCategory['sub_category_name']); ?></b></h4>
                <h4 class="card-title start-align">Price: <b id="sub_category_price"><?php echo htmlspecialchars($subCategory['sub_category_price']); ?></b></h4>
                <h4 class="card-title start-align">Quantity: <b><?php echo htmlspecialchars($subCategory['sub_category_quantity']); ?></b></h4>
                <p class="card-text"><?php echo htmlspecialchars($subCategory['sub_category_description']); ?></p>
            </div>
        </div>
        <?php
    } else {
        echo "Subcategory not found.";
    }
} else {
    echo "Invalid Subcategory ID.";
}
?>
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
