<?php include 'HtDocs/Views/Frontend/Header.php'; ?>
<div class="about_div">
  <img class="banner_img" src="File/cloud.jpeg">
  <div class="img_text">
    <a href="index.php"><p>Specific Image</p></a>
  </div>
</div>
<h1>Customers like these <b><i>categories</i></b></h1>
<?php 
try {
  $latestCategories = $LatestCategory->LatestCategory();?> 
  <div class="row">
    <?php foreach ($latestCategories as $category) {
            $categoryName = $category['latest_search_category'];
            $latestCategoryInfo = $CategoryObj->selectCategoryByName($categoryName);
            foreach ($latestCategoryInfo as $Category) {?>
                <div class="img_user_info">
                    <img class="categorry_view_img" id="scroll-up" onclick="viewSubCategory('<?php echo $Category['category_id']; ?>')" src="<?php echo $Category['category_image']; ?>" alt="Category Image">
                    <input type="hidden" value="<?php echo $Category['category_id']; ?>">
                </div><?php
            }
          }?> 
  </div><?php
} catch (\Throwable $th) {
  echo "Error: " . $th->getMessage();
}
?>
<div id="viewSubCategory" name="prdtContain" class="row sub-cat-view"></div>
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
<?php include 'HtDocs/Views/Frontend/Footer.php'; ?>

