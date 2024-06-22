<?php
 include 'header.php';
if (!isset($_GET['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_GET['user_id'];
$update = new update_login_user;
$user = $update->select_user($conn, $user_id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo $update->update_info_user($conn, $user_id);
}
?>

<div class="form_div col-md-4">
    <h2>Update Profile</h2>
    <form class="form-group" method="post" enctype="multipart/form-data">
        <label for="first_name">First Name:</label>
        <input class="form-control" type="text" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>" required><br>
        <label for="last_name">Last Name:</label>
        <input class="form-control" type="text" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>" required><br>
        <label for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br>
        <label for="profile_image">Profile Image:</label>
        <input class="form-control" type="file" id="profile_image" name="profile_image"><br>
        <button class="btn btn-success" type="submit">Update</button>
    </form>
</div>

<?php include 'footer.php'; ?>
