<?php
namespace users;
namespace profile;

include 'helper/header.php';
$userInfo = new ProfileUser;
$user = $userInfo->current_user($conn);
?>
<script src="js/script.js" defer></script>
<link rel="stylesheet" href="./css/index.css">
<div class="home_content">
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
    // print_r($products);die('sadf');
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
    </div>

<?php include 'helper/footer.php'; ?>

