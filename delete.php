<?php
include 'HtDocs/Views/Frontend/Header.php';
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
   echo  $User->user_delete($conn);
    return "I can't delete my profile";
}else{
    header('Location: home.php');
    exit();
}
?>
