<?php
include 'header.php';
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
<div class="area_info">
    <div class="card">click me</div>
    <div class="card">click me</div>
    <div class="card">click me</div>
    <div class="card">click me</div>
</div>