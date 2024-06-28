<?php
include 'helper/header.php';
if (!isset($_GET['user_id']) || !isset($_GET['profilePath'])) {
    return 'I can\'t get any variable';
}else{
    $profilePath = $_GET['profilePath'];
    $userId = $_GET['user_id'];
    $user = new ProfileUser;
    $user->login_user_profile_picture($conn, $profilePath, $userId);
    return "Profile updated";
}

?>
