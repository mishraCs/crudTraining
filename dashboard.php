<?php
include 'helper/header.php';
 if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
if(!empty($_GET['profile_id'])){
    $profile_id = $_GET['profile_id'];
    $Image = $_GET['Image'];
    $result = new ProfileUser;
    $data = $result->sessionFile($conn, $profile_id, $Image);
        if(isset($data)){?>
            <div id="remove" class="alert alert-danger" role="alert">
                <?php echo "<div id='data' class='form_error'>". $data ."</div>"?>
            </div> <?php
        }else{
            $Image = $_GET['Image'];
            $sql = "SELECT * FROM user_profile WHERE profile_id = '$profile_id'";
            if($conn->query($sql) === true){
                echo "The profile deleted";exit();
            }else{
                echo "profile deletion failed";
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
                                        <a class="dropdown-item" href="add_profile.php?profilePath=<?php echo  $image; ?>&profile_id=<?php echo $user['profile_id']; ?>&user_id=<?php echo $user['user_id']; ?>">Add as profile</a>
                                        <a class="dropdown-item" href="dashboard.php?profile_id=<?php echo $user['profile_id']; ?>&Image=<?php echo $image; ?>" >Delete</a>
                                       <!-- data-toggle="modal" data-target="#deletemodal_<?php //echo $user['profile_id']; ?> -->
                                    </div>
                                    
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
                                                    <a class="btn btn-primary" href="dashboard.php?profile_id=<?php echo $user['profile_id']; ?>&Image=<?php echo $image; ?>">Yes</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal delete -->
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



