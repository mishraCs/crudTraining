<?php include 'helper/header.php';
if(isset($_SESSION['admin_id']) != 1){
  header('location:login.php') ;
  exit();
}?>
<link rel="stylesheet" href="./css/index.css">
<div class="about_div">
  <img class="banner_img" src="File/cloud.jpeg">
  <div class="img_text">
    <a href="index.php"><p>Specific Image</p></a>
  </div>
</div>
<h1>Customers like these <b><i>category</i></b></h1>
<?php 
try {
  $sql = "SELECT latest_search_category FROM latest_search ORDER BY latest_search_category DESC LIMIT 5";
  $result = $conn->query($sql);
  while($category = mysqli_fetch_assoc($result)){
    $category = $category['latest_search_category'];
    $stringSql = "SELECT * FROM category WHERE category_name = '$category'";
    $latestfindCategory = $conn->query($stringSql);
    if($latestfindCategory->num_rows > 0){
      while($Category = mysqli_fetch_assoc($latestfindCategory)){
        $categoryId = $Category['category_id'];?>
          <div class="col-md-3 blur-div">
              <div class="img_user_info">
                <img class="categorry_view_img" id="scroll-up" onclick="viewSubCategory('<?php echo $Category['category_id'];?>')" src="<?php echo $Category['category_image']; ?>" alt="Category Image">
                <input id="categoryId" type="hidden" value="<?php echo $Category['category_id']; ?>">
              </div>
          </div><?php
      }
    }
  }
} catch (\Throwable $th) {
  echo $th->getmessage();
}?>

<div id="viewSubCategory" class="sub-cat-view"></div>
<img class="banner_img" src="File/cloud.jpeg">
<?php include 'helper/footer.php'; ?>
