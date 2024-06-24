<?php
include 'header.php';
if (!isset($_GET['user_id']) || !isset($_GET['profilePath'])) {
    die('I can\'t get any variable');
}
$profilePath = $_GET['profilePath'];
$user_id = $_GET['user_id'];
// die($user_id);
if (!empty($profilePath) && !empty($user_id)) {
    $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE user_id = ?");
    $stmt->bind_param("si", $profilePath, $user_id);
    if ($stmt->execute()) {
        $_SESSION['profile_image'] = $profilePath;
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    die('Profile path or user ID is empty');
}
?>
