<?php
$urlHome = $_SERVER['PHP_SELF'];
if(strpos($urlHome, "home.php")){?>
    <link rel="stylesheet" href="./css/footer.css"><?php
    $sql = "SELECT * FROM users ORDER BY user_id DESC LIMIT 1";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = mysqli_fetch_assoc($result);
        $userId = $row['user_id'];
    }else{
        die('connection errror');
    }
    ?>
    <?php include './2023-footer/footer/dist/index.php'?>
    </div>
    </body>
    </html>
<?php }else{
 echo "You can't access this footer";
}
?>



