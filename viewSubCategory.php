<?php
include 'helper/db.php';
if(isset($_GET['q'])){
    $categoryId = $_GET['q'];
    // echo $categoryId; 
    $subSql = "SELECT * FROM sub_category WHERE category_id = '$categoryId'";
    $subSqlResult = $conn->query($subSql);
    if($subSqlResult->num_rows > 0){
        while($subCategory = mysqli_fetch_assoc($subSqlResult)){?>
            <div class="card col-md-2.5 m-2.5 row-card">
                <div class="card-body text-center img_user_info low-width">
                    <img class="categorry_view_img" src="<?php echo $subCategory['sub_category_image'] ?>" alt="Category Image">
                    <button class="btn btn-danger" id="chk-avl">Buy Now</button>
                    <a id="bbb" class='btn btn-primary'onclick="addToCart(<?php echo $categoryId ?>)">Add to cart</a>
                </div>
                <div class="card-body text-center low-width">
                    <h4 class="card-title start-align" >Name: <b><?php echo $subCategory['sub_category_name'] ?></b></h4>
                    <h4 class="card-title start-align" >Price: <b><?php echo $subCategory['sub_category_price'] ?></b></h4>
                    <h4 class="card-title start-align" >Quantity: <b><?php echo $subCategory['sub_category_quantity'] ?></b></h4>
                    <p class="card-text"><?php echo $subCategory['sub_category_description'] ?></p>
                </div>
            </div>
        <?php
        }
    }
}
?>