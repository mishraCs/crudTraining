<?php
include 'helper/header.php';
$userInfo = new ProfileUser;
$user = $userInfo->current_user($conn);
?>
<link rel="stylesheet" href="./css/index.css">
<div class="about_div">
  <img class="banner_img" src="<?php echo $user['profile_image']; ?>">
  <div class="img_text">
    <p>Specific Image</p>
  </div>
</div>
<h1>Customers are like these product </h1>
  <?php
    $data = new likeCategory;
    $products = $data->selectCustomerMostVisit($conn);
    foreach ($products as $product){?>
      <div><?php echo $product['category_name'] ?></div>;
  <?php }
   ?>
<!-- <div class="area_info">
    <div class="card">click me</div>
    <div class="card">click me</div>
    <div class="card">click me</div>
    <div class="card">click me</div>
</div> -->

<?php include 'helper/footer.php'; ?>

