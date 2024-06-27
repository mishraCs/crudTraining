<?php
include 'header.php';
include 'db.php';
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $user = new DeleteUser;
   echo  $user->user_delete($conn);
    return "i can't delete my profile";
}else{
    header('Location: home.php');
    exit();
}
?>