<?php
 include 'helper/header.php';
 if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
 if(isset($_GET['profile_id'])){
    $profile_id = $_GET['profile_id'];
    $result = new ProfileUser;
    $data = $result->sessionFile($conn, $profile_id);
        if(isset($data)){?>
        <div id="remove" class="alert alert-danger" role="alert">
            <?php echo "<div id='data' class='form_error'>". $data ."</div>"?>
        </div>
<?php }else{
     $stmt = "SELECT * FROM user_profile WHERE profile_id = '$profile_id'";
     $result = $conn->query($stmt);
     $row = $result->fetch_assoc();
     if(unlink($row['profile_image'])){
         echo "profile deleted";
     }else{
         echo("I can't delete this profile");
     }
     $stmt = "DELETE FROM user_profile WHERE profile_id = '$profile_id' ";
     if(mysqli_query($conn, $stmt)){
         echo "all related data deleted";
         header('Location: dashboard.php');
     }else{
         echo('I cant delete data');
     }
}
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();?>
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
           <p><img class="loginInfoImg" src="<?php echo $user['profile_image']; ?>"></p>
        </div>
    </div>
</div>
<!-- Access all file  -->
<?php $userId = $_SESSION['user_id'];
 $profile = new ProfileUser;
$result = $profile->user_file($conn, $userId);?>
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
            if ($result->num_rows > 0) {
                while ($user = $result->fetch_assoc()) {
                    $images = explode(',', $user['profile_image']);
                    foreach ($images as $image) {
            ?>
                        <tr>
                            <td><img src="<?php echo $image; ?>" width="100"></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu pointer">
                                        <a class="dropdown-item" href="add_profile.php?user_id=<?php echo $user['user_id']; ?>&profilePath=<?php echo $image; ?>">Add as profile</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deletemodal_<?php echo $user['profile_id']; ?>">Delete</a>
                                    </div>
                                    <!-- Modal delete -->
                                    <div class="modal fade" id="deletemodal_<?php echo $user['profile_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this profile image?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                    <a class="btn btn-primary" href="dashboard.php?profile_id=<?php echo $user['profile_id']; ?>">Yes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal delete -->
                                </div>
                            </td>
                        </tr>
                    <?php } // end foreach
                } // end while
            } else {
                echo "<tr><td colspan='2'>No users found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php include 'helper/footer.php'; ?>
<script src='./js/script.js'></script>



