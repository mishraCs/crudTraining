<?php include 'HtDocs/Views/Frontend/Header.php';
if (!isset($_GET['user_id'])) {
    header('Location: login.php');
    exit();
}
$userId = $_GET['user_id'];
$user = $User->displayLoginUser($userId);
?>
<div style="display:flex">
    <div class=" user_info container">
        <table class=" table table-bordered info_table col-md-4">
            <tr><td><h2>Welcome, <?php echo $user['first_name']; ?></h2></td></tr>
            <tr><td><p>First Name: <?php echo $user['first_name']; ?></p></td></tr>
            <tr><td><p>Last Name: <?php echo $user['last_name']; ?></p></td></tr>
            <tr><td><p>Email: <?php echo $user['email']; ?></p></td></tr>
            <tr>
                <td>
                    <button type="button" onclick="window.location.href = 'update.php?user_id=<?php echo $user['user_id'];?>';" class=" logout btn btn-success" data-toggle="modal" data-target="#exampleModal">Update</button>
                </td>
            </tr>
        </table>
        <div class=" user_info">
           <p><img class="loginInfoImg" src="<?php echo $user['profile_image']; ?>" alt="please add a profile picture"></p>
        </div>
    </div>
</div>
<?php 
$userFiles = $User->user_file($userId);
?>
<div class="container">
    <h2>User Files</h2>
    <table class="table table-bordered col-lg-6">
        <thead>
            <tr>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($userFiles as $user) {
                $images = explode(',', $user['profile_image']);
                foreach ($images as $image) {
            ?>
                    <tr>
                        <td><img src="<?php echo $image; ?>" width="100"></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu pointer">
                                    <a class="dropdown-item" href="add_profile.php?profilePath=<?php echo $image; ?>&profile_id=<?php echo $user['profile_id']; ?>&user_id=<?php echo $user['user_id']; ?>">Add as profile</a>
                                    <a class="dropdown-item" href="dashboard.php?profile_id=<?php echo $user['profile_id']; ?>&Image=<?php echo $image; ?>" >Delete</a>
                                </div>
                            </div>

                            <!-- Modal delete -->
                            <div class="modal fade" id="deletemodal_<?php echo $user['profile_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModallllLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModallllLabel">Confirm Deletion</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this profile image?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            <a class="btn btn-primary" href="dashboard.php?profile_id=<?php echo $user['profile_id']; ?>&Image=<?php echo $image; ?>">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal delete -->
                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</div>
<?php include 'HtDocs/Views/Frontend/Footer.php'; ?>
