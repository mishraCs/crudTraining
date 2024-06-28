<?php
include 'helper/header.php';
if (isset($_GET['profilePath'])) {
    $profilePath = $_GET['profilePath'];
    $userId = $_GET['user_id'];
    $user = new ProfileUser;
    $user->update_profile_picture($conn, $profilePath, $userId);
    return "profile updated";
    exit();
}
?>
