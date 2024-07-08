<?php
include 'helper/header.php';
if (!isset($_GET['profilePath'])) {
    echo  'I can\'t get any variable';
}else{
    $profilePath = $_GET['profilePath'];
    $profileId = $_GET['profile_id'];
    $userId = $_GET['user_id'];

    $user = new ProfileUser;
    $data = $user->login_user_profile_picture($conn, $profilePath, $profileId, $userId);
    echo "get it";
    return $data;
}
// header('Location:dashboard.php');
?>

