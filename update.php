<?php
include 'HtDocs/Views/Frontend/Header.php';
if (!isset($_GET['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_GET['user_id'];
$user = $User->displayLoginUser($user_id);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updateMessage = $UserUpdate->update_info_user($user_id);
    if (!empty($updateMessage)) {
        ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($updateMessage) . "<br>"; ?>
        </div>
        <?php
    }
}
?>
<div class="form_div">
    <h2>Update Profile</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label for="first_name">First Name:</label>
        <input class="form-control" type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required><br>
        
        <label for="last_name">Last Name:</label>
        <input class="form-control" type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required><br>
        
        <div>
            <img class="updateImg" src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="please add a profile picture">
        </div>
        
        <label for="profile_image">Profile Image:</label>
        <input class="form-control" type="file" id="profile_image" name="profile_image"><br>
        
        <button class="btn btn-success" type="submit">Update</button>
    </form>
</div>
<?php include 'HtDocs/Views/Frontend/Footer.php'; ?>
