<?php
include 'helper/header.php';
if (!empty($_GET['subCategoryId'])) {
   $data = new Subcategory;
    $subCategory = $data->subCategoryView();
}
?>
 <div class="container-fluid">
 <div class="row justify-content-between ">
<?php for($i=0; $i<20; $i++){?>
      <div class="category_card col-md-3 ml-0 mr-0">
        <img class="categorry_view_img" src="<?php echo $subCategory['sub_category_image'] ?>" alt="Category Image">
        <h4>Name: <b><?php echo $subCategory['sub_category_name'] ?></b></h4>
        <p class="card_content"><?php echo $subCategory['sub_category_description'] ?></p>
      </div>
<?php } ?>
</div>
</div>




