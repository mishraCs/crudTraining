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
    <link rel="stylesheet" href="./css/cart.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet"/>
    <!-- localscript -->
    <script src="js/script.js"></script>
    <script src="js/Cookie.js"></script>
    <!-- sidebar link -->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function(){
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/6683fcb5eaf3bd8d4d172f61/1i1pp69gc';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
        <div class="home_content">
            <header>
                <div class="header_nav">
                    <nav class="header_element">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a class="header_link" href="home.php">Home</a>
                            <a class="header_link" href="index.php" alt="click">About</a>
                            <a class="header_link" href="cart.php" alt="click">MyCart</a>
                        <?php else: ?>
                            <a class="header_link" href="register.php">Register</a>
                            <a class="header_link" href="login.php">Login</a>
                            <div class="btn-group">
                        <?php endif; ?>
                        <div class="user_div">
                            <?php if (isset($_SESSION['user_id'])){
                                $header_user = new ProfileUser;
                                $row = $header_user->current_user($conn);?>
                                <a class="header_link user-name" href="dashboard.php"><?php echo $row['first_name']; ?></a>
                                <img onclick="window.location.href = 'dashboard.php'" class="header_user_image" src="<?php echo $row['profile_image']; ?>" alt="userImage">
                            <?php } ?>
                        </div>
                    </nav>
                </div>
            </header>
