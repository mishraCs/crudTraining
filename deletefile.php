
<?php
include 'header.php';
if(isset($_GET['profile_id'])){
    $profile_id = $_GET['profile_id'];
    $result = new ProfileUser;
    $data = $result->sessionFile($conn, $profile_id);
    if(isset($data)){
     ?>
     
     
     <div class="alert alert-danger" role="alert">
        <?php echo "<div id='data'>". $data ."</div>" ?>
      </div>

      <?php } ?>
     <div id="delete_profile_error">
        <a class="dropdown-item" type="button" data-toggle="modal" data-target="#deletemodal">Delete</a>
        <span class="form_error"></span>
    </div>
    <?php
    
    if(!isset($data)){
        // die("i can delete my profile");
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
    }



}else{
    // echo "Sorry, here not any information about you";
    // header('Location: home.php');
    // die("hello user");
}
    // die("i can't delete my profile");

?>
<script src='./js/script.js'></script>