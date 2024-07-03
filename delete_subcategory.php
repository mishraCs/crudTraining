<?php
include 'helper/header.php';
// ob_start();
if(isset($_POST['submit'])){
       $subCategoryId = $_POST['sub_category_select'];
       echo  $sql = "DELETE FROM sub_category WHERE sub_category_id = $subCategoryId"; 
        $conn->query($sql);
        ?>
        <script>
            window.location.replace('home.php?msg=data have been deleted succesfully');
        </script>
    <?PHP }
?>
<div class="form_div col-md-4">
    <h2>Delete sub_Category</h2>
<form class="form-group" action="" method="post" enctype="multipart/form-data">
        <label>Select sub_Category</label><br>
        <select name="sub_category_select">
            <?php $sql = "SELECT *FROM sub_category";
            $result = $conn->query($sql);
            while($sub_category = mysqli_fetch_assoc($result)){?><br>
            <option value="<?php echo $sub_category['sub_category_id'] ?>"><?php echo $sub_category['sub_category_name'] ?></option>
            <?php }?>
        </select><br>
        <button class="btn btn-success" name="submit" type="submit">Submit</button>
</form>
</div>
