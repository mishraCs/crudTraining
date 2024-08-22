<?php include 'HtDocs/Views/Frontend/Header.php';
if (isset($_SESSION['user_id'])){
    $userId = $_SESSION['user_id'];
    $row = $User->displayLoginUser($userId);
    if(isset($_POST['submit'])){
        $_SESSION['form_data'] = $_POST;
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $fileName = basename($_FILES['profile_image']['name']);
            $uploadFilePath = $uploadDir . $fileName;
            if(!file_exists($uploadFilePath)){
                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFilePath)) {
                    $_SESSION['form_data']['profile_image'] = $uploadFilePath;
                } else {
                    $_SESSION['form_data']['profile_image_error'] = 'File upload failed.';
                }
            }
        }
    }
    if (isset($_GET['subCategoryId'])){
        $subCategoryId = $_GET['subCategoryId'];
        $subSqlResult = $SubCategoryObj->subCategoryView($subCategoryId);
?>  
     
<div class="form-div col-md-12">
    <div class="card col-md-2.5 m-2.5 row-card view-sub-category_card">
        <div class="card-body text-center img_user_info low-width">
            <img id="sub_category_img" class="categorry_view_img" src="<?php echo $subSqlResult['sub_category_image']; ?>" alt="Category Image">
        </div>
        <div class="card-body text-center low-width view-sub-category_body ">
            <h4 class="card-title start-align">Name: <b id="sub_category_name"><?php echo $subSqlResult['sub_category_name']; ?></b></h4>
            <h4 class="card-title start-align">Price: <b id="sub_category_price"><?php echo $subSqlResult['sub_category_price']; ?></b></h4>
            <h4 class="card-title start-align">Quantity: <b id="sub_category_quantity"><?php echo $subSqlResult['sub_category_quantity']; ?></b></h4>
            <p class="card-text"><?php echo $subSqlResult['sub_category_description']; ?></p>
        </div>
    </div><?php }?>
    <div class="form-header col-md-11">
        <h3>Purchase Form</h3>
        <p>Please fill in your details as per your Aadhaar or government ID</p>
    </div>
    <div class="form-body">
        <form class="form-group" method="post" name="purchaseForm" id="BuyForm"  enctype="multipart/form-data">
            <div class="col-md-5">
                <label for="first_name">First Name:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="first_name" name="first_name" value="<?php echo $row['first_name'] ?>" required>
            </div>
            <div class="col-md-5">
                <label for="last_name">Last Name:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="last_name" name="last_name" value="<?php echo $row['last_name'] ?>" required>
            </div>
            <div class="col-md-5">
                <label for="email">Email:</label>
                <span class="form_error"></span>
                <input class="form-control" type="email" id="email" name="email" value="<?php echo $row['email'] ?>" required>
            </div>
            <div class="col-md-5">
                <label for="phone">Phone Number:</label>
                <span class="form_error"></span>
                <input class="form-control" type="tel" id="phone" name="phone"  value="<?php echo isset($_SESSION['form_data']['phone']) ? $_SESSION['form_data']['phone'] : ''; ?>"required pattern="[0-9]{10}">
            </div>
            <div class="col-md-5">
                <label for="street">Street Address:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="street" name="street"  value="<?php echo isset($_SESSION['form_data']['street']) ? $_SESSION['form_data']['street'] : ''; ?>"required>
            </div>
            <div class="col-md-5">
                <label for="block">Block/Area:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="block" name="block"  value="<?php echo isset($_SESSION['form_data']['block']) ? $_SESSION['form_data']['block'] : ''; ?>"required>
            </div>
            <div class="col-md-5">
                <label for="village_city">Village/City:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="village_city" name="village_city"  value="<?php echo isset($_SESSION['form_data']['village_city']) ? $_SESSION['form_data']['village_city'] : ''; ?>"required>
            </div>
            <div class="col-md-5">
                <label for="state">State:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="state" name="state"  value="<?php echo isset($_SESSION['form_data']['state']) ? $_SESSION['form_data']['state'] : ''; ?>"required>
            </div>
            <div class="col-md-5">
                <label for="postal_code">Postal Code:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="postal_code" name="postal_code"  value="<?php echo isset($_SESSION['form_data']['postal_code']) ? $_SESSION['form_data']['postal_code'] : ''; ?>"required pattern="[0-9]{6}">
            </div>
            <div id="permanent_address_fields" style="display: none;">
                <div class="col-md-5">
                    <label for="permanent_street">Permanent Street Address:</label>
                    <span class="form_error"></span>
                    <input class="form-control" type="text" id="permanent_street" name="permanent_street"  value="<?php echo isset($_SESSION['form_data']['permanent_street']) ? $_SESSION['form_data']['permanent_street'] : ''; ?>">
                </div>
                <div class="col-md-5">
                    <label for="permanent_block">Permanent Block/Area:</label>
                    <span class="form_error"></span>
                    <input class="form-control" type="text" id="permanent_block" name="permanent_block"  value="<?php echo isset($_SESSION['form_data']['permanent_block']) ? $_SESSION['form_data']['permanent_block'] : ''; ?>">
                </div>
                <div class="col-md-5">
                    <label for="permanent_village_city">Permanent Village/City:</label>
                    <span class="form_error"></span>
                    <input class="form-control" type="text" id="permanent_village_city" name="permanent_village_city"  value="<?php echo isset($_SESSION['form_data']['permanent_village_city']) ? $_SESSION['form_data']['permanent_village_city'] : ''; ?>">
                </div>
                <div class="col-md-5">
                    <label for="permanent_state">Permanent State:</label>
                    <span class="form_error"></span>
                    <input class="form-control" type="text" id="permanent_state" name="permanent_state"  value="<?php echo isset($_SESSION['form_data']['permanent_state']) ? $_SESSION['form_data']['permanent_state'] : ''; ?>">
                </div>
                <div class="col-md-5">
                    <label for="permanent_postal_code">Permanent Postal Code:</label>
                    <span class="form_error"></span>
                    <input class="form-control" type="text" id="permanent_postal_code" name="permanent_postal_code" pattern="[0-9]{6}" value="<?php echo isset($_SESSION['form_data']['permanent_postal_code']) ? $_SESSION['form_data']['permanent_postal_code'] : ''; ?>">
                </div>
            </div>
            <div class="col-md-5">
                <label for="profile_image">Profile Image:</label>
                <span class="form_error">
                    <?php echo isset($_SESSION['form_data']['profile_image_error']) ? $_SESSION['form_data']['profile_image_error'] : ''; ?>
                </span>
                <input class="form-control" type="file" id="profile_image" name="profile_image" <?php echo isset($_SESSION['form_data']['profile_image']) ? '' : 'required'; ?>>

                <?php if (isset($_SESSION['form_data']['profile_image'])): ?>
                    <div>
                        <p>Current Uploaded Image:</p>
                        <img src="<?php echo $_SESSION['form_data']['profile_image']; ?>" alt="Profile Image" style="max-width: 100px;">
                        <p>Choose a new image to replace the current one.</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-12">
                <label>
                    <input type="checkbox" id="same_as_permanent" name="same_as_permanent" onclick="togglePermanentAddress()"  value="<?php echo isset($_SESSION['form_data']['street']) ? $_SESSION['form_data']['street'] : ''; ?>"> different as Permanent Address
                </label>
            </div>
            <div class="smbtBuy col-md-10">
                <button class="btn btn-primary smbtBuyBtn" name="submit" id="buy-form-btn" type="submit">Buy</button>
            </div>
        </form>
    </div>
</div>
<?php include 'HtDocs/Views/Frontend/Footer.php';
}else{
    header('Location:login.php');
} ?>

 
<script>
const FormInput = document.getElementById('BuyForm');
FormInput.addEventListener('input', () => {
    sessionStorage.setItem('streetValue', streetInput.value);
});

window.addEventListener('load', () => {
    const savedStreetValue = sessionStorage.getItem('streetValue');
    if (savedStreetValue) streetInput.value = savedStreetValue;
});
</script>
 