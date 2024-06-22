<?php include 'header.php'; ?>
<?php include 'db.php'; ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>
<div style="display:flex">
    <div class=" user_info container col-md-4">
        <table>
            <tr><td><h2>Welcome, <?php echo $user['first_name']; ?></h2></td></tr>
            <tr><td><p>First Name: <?php echo $user['first_name']; ?></p></td></tr>
            <tr><td><p>Last Name: <?php echo $user['last_name']; ?></p></td></tr>
            <tr><td><p>Email: <?php echo $user['email']; ?></p></td></tr>
            <tr><td> <button type="button" onclick="window.location.href = 'update.php?user_id=<?php echo $user['user_id'];?>';" class=" logout btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        Update
                        </button></td></tr>
        </table>
        <!-- <a href="update.php?user_id=<?php //echo $user['user_id'];?>">Update Profile</a> -->
    </div>
    <div class=" user_info">
        <p><img src="<?php echo $user['profile_image']; ?>"></p>
    </div>
</div>

<?php include 'footer.php'; ?>
