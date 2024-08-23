<?php 
ob_start();
session_start();
spl_autoload_register(function ($class) {
  $baseDir = $_SERVER['DOCUMENT_ROOT'] . '/MyCode/CRUD/HtDocs/';
  $relativeClass = str_replace('\\', '/', $class);
  $filePath = $baseDir . $relativeClass . '.php';
  if (file_exists($filePath)) {
      include $filePath;
  } else {
      echo "File not found: " . $filePath . "<br>";
  }
});
$UserUpdate = new \Controller\UserUpdate();
$User = new \Controller\User();
$LatestCategory = new \Controller\Search();
$CategoryObj = new \Controller\Category();
$SubCategoryObj = new \Controller\SubCategory();
$CartCategory = new \Controller\CategoryCart();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecomerce Project</title>
    <link rel="stylesheet" href="HtDocs/Assets/Css/Index.css">
    <link rel="stylesheet" href="HtDocs/Assets/Css/Style.css">
    <link rel="stylesheet" href="HtDocs/Assets/Css/Cart.css">
    <link rel="stylesheet" href="HtDocs/Assets/Css/Footer.css">
    <link rel="stylesheet" href="HtDocs/Assets/Css/ReHeader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet"/>
    <script src="HtDocs/Assets/js/Script.js"></script>
    <script src="HtDocs/Assets/js/Cookie.js"></script>
    <!-- <script src="HtDocs/Assets/js/CookiSubCat.js"></script> -->
    <script src="HtDocs/Assets/js/Index.js" type="text/babel"></script>
    <!-- footer home -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <!-- footer home -->
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> 
<?php include 'Sidebar.php'; ?>
<div class="home_content">
  <header class="header header-content">
    <nav>
      <div class="logo"> <?php if (isset($_SESSION['user_id'])){
          $userId = $_SESSION['user_id'];
          $row = $User->displayLoginUser($userId);?>
        <a class="header_link user-name" href="dashboard.php"><?php echo $row['first_name']; ?></a>
        <img onclick="ProfilePopup()" class="header_user_image" src="<?php echo $row['profile_image']; ?>" alt="userImage">
        <?php } ?>
      </div>
      <input type="checkbox" id="menu-toggle">
      <label for="menu-toggle" class="menu-icon">&#9776;</label>
      <ul class="menu"><?php if (isset($_SESSION['user_id'])): ?>
        <li><a id="hello-admin" class="header_link" href="home.php">Admin Page</a></li>
        <li><a class="header_link" href="index.php" alt="click">Index</a></li>
        <li><a class="header_link" href="cart.php" alt="click">MyCart</a></li>
        <?php else: ?>
          <a class="header_link" href="register.php">Register</a>
          <a class="header_link" href="login.php">Login</a>
          <div class="btn-group">
      </ul><?php endif; ?>
    </nav>
  </header>
  <!-- Modal Profile Popup -->
  <div class="personal-modal modal fade cart-add-product add-cart-modal" id="Profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog profile-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
        <?php
          if (isset($_SESSION['user_id'])){
              $userId = $_SESSION['user_id'];
              // $row = $User->displayLoginUser($userId);?>
          <a class="header_link user-name" href="dashboard.php">Welcome in MultiThink <?php echo $row['first_name']; ?></a>
          <img src="" alt="">
          <?php } ?></div>
        <div class="modal-footer">
          <img class="header_user_image" src="<?php echo $row['profile_image']; ?>" alt="blue-logo">
          <button type="button" class=" button-star btn btn-danger" data-dismiss="modal">Close
              <div class="star"></div>
          </button>
        </div>
      </div>
    </div>
  </div>
<!-- Modal Profile Popup -->
