<?php
include 'header.php';
if (!isset($_GET['user_id']) || !isset($_GET['profilePath'])) {
    return 'I can\'t get any variable';
}else{
    $profilePath = $_GET['profilePath'];
    $user = new ProfileUser;
    $user->update_profile_picture($conn, $profilePath);
    return "hello";
}

?>
