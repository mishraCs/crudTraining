<?php
namespace users;

include 'helper/header.php';
ob_start();
if(isset($_POST['submit'])){
       $data = new DeCategory;
       echo $data->deleteCategory();
        //header('Location:home.php?successfullydelete');
    //     ?>
       <script>
    //         window.location.replace('home.php?msg=data have been deleted succesfully');
    //     </script>
    <?PHP }
?>
<div class="form_div col-md-4">
    <h2>Add Category</h2>
<form class="form-group" action="" method="post" enctype="multipart/form-data">
        <label>Select Category</label><br>
        <select name="category_select">
            <?php $sql = "SELECT *FROM category";
            $result = $conn->query($sql);
            while($category = mysqli_fetch_assoc($result)){?><br>
            <option value="<?php echo $category['category_id'] ?>"><?php echo $category['category_name'] ?></option>
            <?php }?>
        </select><br>
        <button class="btn btn-success" name="submit" type="submit">Submit</button>
</form>
</div>
