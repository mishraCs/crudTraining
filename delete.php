<?php
include 'header.php';
include 'db.php';
// include_once 'class_function.php';
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $user = new delete_user;
   echo  $user->user_delete($conn);
    die("i can't delete my profile");
}else{
    echo "Sorry, here not any information about you";
    header('Location: home.php');
    exit();
}
?>