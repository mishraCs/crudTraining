<?php 
 ob_start();
 session_start();
 include 'db.php';
 include 'Controller/class_function.php';
 include 'Controller/users.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Operation</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">   <!-- bootstrap cdn -->
    <!-- nested dropdwon -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"rel="stylesheet"/>
<!--localscript  -->
<script src="js/script.js" defer></script>
<!-- sidebar link -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- chat -->
<script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/6683fcb5eaf3bd8d4d172f61/1i1pp69gc';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
</script>
</head>
<body>
<!-- Modal logout -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Wait!! are you want logout yourself.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a type="button" class="btn btn-primary" href="logout.php" >Yes</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal logout -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>  <!-- bootstrap cdn -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script> 
<script> // category
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $('.dropdown-submenu ul').hide();
    $(this).next('ul').toggle();
 
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
<body>
  <?php include 'helper/sidebar.php'; ?>
  <div class="home_content ">
   <header>
        <div class="header_nav">
        <nav class="header_element">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a class="header_link" href="home.php">Home</a>
                    <a class="header_link" href="index.php" alt="click">About</a>
                    <button type="button" class=" logout btn btn-danger" data-toggle="modal" data-target="#exampleModal">Logout</button>
                <?php else: ?>
                    <a class="header_link" href="register.php">Register</a>
                    <a class="header_link" href="login.php">Login</a>
                    <div class="btn-group">
                <?php endif; ?>
                <div class="user_div">
                    <?php if (isset($_SESSION['user_id'])){
                        $header_user = new ProfileUser;
                        $row = $header_user->current_user($conn);?>
                        <img onclick="window.location.href = 'dashboard.php' " class="header_user_image" src="./File/myCart.jpeg" alt="Cart">
                        <a class="header_link" href="dashboard.php"><?php echo $row['first_name']; ?></a>
                        <img onclick="window.location.href = 'dashboard.php' " class="header_user_image" src="<?php echo $row['profile_image']; ?>">
                    <?php } ?>
                </div>
                <div class="category user_div dropdown">
                  <button class="btn btn-default" type="button" data-toggle="dropdown">Category
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu"><?php
                      $sql = "SELECT * FROM category";
                      $result = $conn->query($sql);
                      if(mysqli_num_rows($result) > 0) {
                          while($category = mysqli_fetch_assoc($result)) { ?>
                              <li class="dropdown-submenu">
                                  <div style="display:flex">
                                      <img class="header_user_image" src="<?php echo $category['category_image'] ?>" alt="">
                                      <a class="test" tabindex="-1" href="#"><?php echo $category['category_name'] ?></a>
                                      <ul class="dropdown-menu">
                                          <?php
                                          $category_id = $category['category_id'];
                                          $sub_sql = "SELECT * FROM sub_category WHERE category_id = $category_id";
                                          $sub_result = $conn->query($sub_sql);
                                          if(mysqli_num_rows($sub_result) > 0) {
                                              while($subCategory = mysqli_fetch_assoc($sub_result)) { ?>
                                                  <li><div style="display:flex">
                                                    <img class="header_user_image" src="<?php echo $subCategory['sub_category_image'] ?>" alt="">
                                                    <a tabindex="-1" href="sub_category_view.php?subCategoryId=<?php echo $subCategory['sub_category_id']; ?>&category=<?php echo $category['category_name']; ?>"><?php echo $subCategory['sub_category_name'] ?></a></div></li>
                                              <?php }
                                          } ?>
                                      </ul>
                                  </div>
                              </li>
                          <?php }
                      } ?>
                  </ul>
              </div>
            </nav>
        </div>
    </header>
