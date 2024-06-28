<?php include 'helper/header.php';
if (!isset($_GET['user_id'])) {
    header('Location: login.php');
    exit();
}
$userId = $_GET['user_id'];
$sql = "SELECT *FROM users WHERE user_id = '$userId' ";
$result = $conn->query($sql);
if($result->num_rows>0){
   $user = $result->fetch_assoc();
}
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
<?php $profile = new ProfileUser;
$result = $profile->user_file($conn,$userId);?>
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
            <?php if ($result->num_rows > 0) {
                    while($user = $result->fetch_assoc()) {?>
                            <tr>
                                <td><img src="<?php echo $user['profile_image']; ?>" width="100"></td>
                                <td>
                                    <div class="btn-group">
                                        <button onclick="demmo()" id="removeButton" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                        <div class="dropdown-menu pointer">
                                            <a class="dropdown-item" href="user_profile_update.php?user_id=<?php echo $user['user_id']; ?>&profilePath=<?php echo $user['profile_image']; ?>">Add as profile</a>
                                               <a  class="dropdown-item " type="button" data-toggle="modal" data-target="#deletemodal<?php echo $user['profile_id']; ?>">Delete</a>
                                        </div>
                                    </div>
                                    <!-- Modal delete -->
                                    <div class="modal fade" id="deletemodal<?php echo $user['profile_id']; ?>" tabindex="-1" role="dialog"   aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                 </div>
                                                    <div class="modal-body">
                                                        Please confirm!! are you want delete your profile.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                        <button type="button" class="btn btn-primary" onclick="window.location.href='dashboard.php?profile_id=<?php echo $user['profile_id']; ?>'" >Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <!-- Modal delete -->  
                                </td>
                            </tr>
                 <?php }
                } else {
                    echo "<tr><td colspan='2'>No users found.</td></tr>";
                }?>
        </tbody>
    </table>
    
</div>
<?php include 'helper/footer.php'; ?>
<script src='./js/script.js'></script>
