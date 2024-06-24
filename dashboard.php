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
            <tr>
                <td>
                    <button type="button" onclick="window.location.href = 'update.php?user_id=<?php echo $user['user_id'];?>';" class=" logout btn btn-success" data-toggle="modal" data-target="#exampleModal">Update
                    </button>
                </td>
            </tr>
        </table>
    </div>
    <div class=" user_info">
        <p><img src="<?php echo $user['profile_image']; ?>"></p>
    </div>
</div>

<!-- Access all file  -->
<?php 
$profile = new profile_user;
$result = $profile->user_file($conn);
?>
<div class="container">
    <h2>User List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result->data_seek(0);
        if ($result->num_rows > 0) {
            while($user = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><img src="<?php echo $user['profile_image']; ?>" width="100"></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action
                    </button>
                    <div class="dropdown-menu pointer">
                    <a class="dropdown-item" href="add_profile.php?user_id=<?php echo $user['user_id']; ?>&profilePath=<?php echo $user['profile_image']; ?>">Add as profile</a>
                        <a class="dropdown-item pointer" type="button" data-toggle="modal" data-target="#deletemodal">Delete</a>
                    </div>
                </div>
            </td>
        </tr>
        <!-- Modal delete -->
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            Please confirm!! are you want delete your profile.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <button type="button" class="btn btn-primary" onclick="window.location.href='deletefile.php?profile_id=<?php echo $user['profile_id']; ?>'" >Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- Modal delete -->
        <?php 
            }
        } else {
            echo "<tr><td colspan='2'>No users found.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>



