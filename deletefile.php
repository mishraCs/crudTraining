
<?php
include 'header.php';
if(isset($_GET['profile_id'])){
    $profile_id = $_GET['profile_id'];
    $result = new ProfileUser;
    $data = $result->sessionFile($conn, $profile_id);
    if(isset($data)){?>
    <div class="alert alert-danger" role="alert">
        <?php echo "<div id='data'>". $data ."</div>" ?>
    </div>
    <?php }?>
    <div id="delete_profile_error">
        <a class="dropdown-item" type="button" data-toggle="modal" data-target="#deletemodal">Delete</a>
        <span class="form_error"></span>
    </div>
    <?php if(!isset($data)){
       $data = new CategoryInsert;
       echo $data->DeleteUserProfile();
    }
}else{
    echo "Sorry, here not any information about you";
}?>
<script src='./js/script.js'></script>