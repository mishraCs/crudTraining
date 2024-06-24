<?php
include 'header.php';
if(isset($_GET['profile_id'])){
    $profile_id = $_GET['profile_id'];
    // die($profile_id);
//     $user = new delete_user;
//    echo  $user->user_delete($conn);
    // die("i can't delete my profile");
    $stmt = "SELECT * FROM user_profile WHERE profile_id = '$profile_id'";
    $result = $conn->query($stmt);
    $row = $result->fetch_assoc();
    if(unlink($row['profile_image'])){
        echo "profile deleted";
    }else{
        echo('I cant delete');
    }

    $stmt = "DELETE FROM user_profile WHERE profile_id = '$profile_id' ";
    if(mysqli_query($conn, $stmt)){
        echo "all related data deleted";
        header('Location: dashboard.php');
    }else{
        echo('I cant delete data');
    }



}else{
    echo "Sorry, here not any information about you";
    header('Location: home.php');
    die("hello user");
}
?>