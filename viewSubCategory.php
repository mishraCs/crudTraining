<?php
// include 'helper/header.php';
include 'helper/db.php';
if(isset($_GET['q'])){
    $categoryId = $_GET['q'];
    echo $categoryId; 
    $subSql = "SELECT * FROM sub_category WHERE category_id = '$categoryId'";
    $subSqlResult = $conn->query($subSql);
    if($subSqlResult->num_rows > 0){
        while($subCategory = mysqli_fetch_assoc($subSqlResult)){?>
        <div style="display:flex">
            <div class=" user_info container">
                <div class=" img_user_info col-md-5">
                <img class="categorry_view_img" src="<?php echo $subCategory['sub_category_image'] ?>" alt="Category Image">
                <div class="col_div">
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
        
        <?php
            
        }
    }

}
?>