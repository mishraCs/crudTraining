<?php
require_once 'HtDocs/Controller/CreateConnection.php';

require_once 'HtDocs/Controller/SubCategory.php';

$subCategoryObj = new \Controller\SubCategory();
if (isset($_GET['q'])) {
    $categoryId = $_GET['q'];
    $subCategory = $subCategoryObj->selectSubCategoryByName($categoryId);
    foreach ($subCategory as $subSqlResult): ?>
        <div class="blur-div">
            <div class="img_user_info">
                <img id="sub_category_img" class="categorry_view_img" src="<?php echo $subSqlResult['sub_category_image']; ?>" alt="Category Image">
            </div>
            <div class="card-body text-center low-width view-sub-category_body ">
                <h1 id="subCategoryId" style="display:none"><?php echo $subSqlResult['sub_category_id'] ?></h1>
                <h4 class="card-title start-align">Name: <b id="sub_category_name"><?php echo $subSqlResult['sub_category_name']; ?></b></h4>
                <h4 class="card-title start-align">Price: <b id="sub_category_price"><?php echo $subSqlResult['sub_category_price']; ?></b></h4>
                <h4 class="card-title start-align">Quantity: <b id="sub_category_quantity"><?php echo $subSqlResult['sub_category_quantity']; ?></b></h4>
                <button class="btn btn-danger col-md-12" onclick="window.location.href = 'BuyForm.php?subCategoryId=<?php echo $subSqlResult['sub_category_id']; ?>'">Buy Now</button>
                <a id="bbb" class='btn btn-primary col-md-12' onclick="addAsCookie()">Add to cart</a>
                <a id="bbb" class='btn btn-primary col-md-12' onclick="removeAsCookie('<?php echo $subSqlResult['sub_category_name']; ?>')">Remove From cart</a>
            </div>
            
        </div>
    <?php endforeach; 
}
?>
