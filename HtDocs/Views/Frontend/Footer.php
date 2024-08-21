<?php
$urlHome = $_SERVER['PHP_SELF'];
if(strpos($urlHome, "home.php")){?>
    <?php include 'Library/2023-footer/footer/dist/index.php'?>
    </div>
    </body>
    </html>
<?php }else{
    ?> <link rel="stylesheet" href="HtDocs/Assets/Css/PblcFotr.css"><?php
    include 'PublicFooter.php';
}
?>
       




