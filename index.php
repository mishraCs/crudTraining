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
<!-- select and view details latest search for user -->
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
              <div class=" img_user_info">
                <img class="categorry_view_img" id="scroll-up" onclick="viewSubCategory('<?php echo $Category['category_id'];?>')" src="<?php echo $Category['category_image']; ?>" alt="Category Image">
                <input id="categoryId" type="hidden" value="<?php echo $Category['category_id']; ?>">
              </div>
          </div><?php
      }
    }
  }
} catch (\Throwable $th) {
  echo $th->getmessage();
}

?>
<div id="viewSubCategory" class="sub-cat-view"></div> // to view
<!-- select latest search -->
<script>
function viewSubCategory(str){
var xmlhttp=new XMLHttpRequest(str);
xmlhttp.onreadystatechange=function() {
  if (this.readyState==4 && this.status==200) {
    document.getElementById("viewSubCategory").innerHTML=this.responseText;
    document.getElementById("viewSubCategory").style.border="1px solid #A5ACB2";
  }
}
xmlhttp.open("GET","viewSubCategory.php?q="+str,true);
xmlhttp.send();
}
(function ($,jQuery) {
$('#scroll-up').on('click', function() {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
});})(jQuery);
</script>
<?php include 'helper/footer.php'; ?>

