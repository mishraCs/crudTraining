<?php include 'helper/header.php';
$crentUser = new ProfileUser;
$user = $crentUser->current_user($conn);
?>
<div class="form-div col-md-11">
    <div class="form-header col-md-11">
        <h3>Purchase Form</h3>
        <p>Please fill in your details as per your Aadhaar or government ID</p>
    </div>
    <div class="form-body">
        <form class="form-group" method="post" name="purchaseForm" onsubmit="return validateForm()" enctype="multipart/form-data">
            <div class="col-md-5">
                <label for="first_name">First Name:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="first_name" name="first_name" value="<?php echo $user['first_name'] ?>" required>
            </div>
            <div class="col-md-5">
                <label for="last_name">Last Name:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="last_name" name="last_name" value="<?php echo $user['last_name'] ?>" required>
            </div>
            <div class="col-md-5">
                <label for="email">Email:</label>
                <span class="form_error"></span>
                <input class="form-control" type="email" id="email" name="email" value="<?php echo $user['email'] ?>" required>
            </div>
            <div class="col-md-5">
                <label for="phone">Phone Number:</label>
                <span class="form_error"></span>
                <input class="form-control" type="tel" id="phone" name="phone" required pattern="[0-9]{10}">
            </div>
            <div class="col-md-5">
                <label for="street">Street Address:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="street" name="street" required>
            </div>
            <div class="col-md-5">
                <label for="block">Block/Area:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="block" name="block" required>
            </div>
            <div class="col-md-5">
                <label for="village_city">Village/City:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="village_city" name="village_city" required>
            </div>
            <div class="col-md-5">
                <label for="state">State:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="state" name="state" required>
            </div>
            <div class="col-md-5">
                <label for="postal_code">Postal Code:</label>
                <span class="form_error"></span>
                <input class="form-control" type="text" id="postal_code" name="postal_code" required pattern="[0-9]{6}">
            </div>
            <div id="permanent_address_fields" style="display: none;">
                <div class="col-md-5">
                    <label for="permanent_street">Permanent Street Address:</label>
                    <span class="form_error"></span>
                    <input class="form-control" type="text" id="permanent_street" name="permanent_street">
                </div>
                <div class="col-md-5">
                    <label for="permanent_block">Permanent Block/Area:</label>
                    <span class="form_error"></span>
                    <input class="form-control" type="text" id="permanent_block" name="permanent_block">
                </div>
                <div class="col-md-5">
                    <label for="permanent_village_city">Permanent Village/City:</label>
                    <span class="form_error"></span>
                    <input class="form-control" type="text" id="permanent_village_city" name="permanent_village_city">
                </div>
                <div class="col-md-5">
                    <label for="permanent_state">Permanent State:</label>
                    <span class="form_error"></span>
                    <input class="form-control" type="text" id="permanent_state" name="permanent_state">
                </div>
                <div class="col-md-5">
                    <label for="permanent_postal_code">Permanent Postal Code:</label>
                    <span class="form_error"></span>
                    <input class="form-control" type="text" id="permanent_postal_code" name="permanent_postal_code" pattern="[0-9]{6}">
                </div>
            </div>
            <div class="col-md-5">
                <label for="profile_image">Profile Image:</label>
                <span class="form_error"></span>
                <input class="form-control" type="file" id="profile_image" name="profile_image" required>
            </div>
            <div class="col-md-12">
                <label>
                    <input type="checkbox" id="same_as_permanent" name="same_as_permanent" onclick="togglePermanentAddress()"> different as Permanent Address
                </label>
            </div>
            <div class="smbtBuy col-md-10">
                <button class="btn btn-primary smbtBuyBtn" name="submit" type="submit">Buy</button>
            </div>
        </form>
    </div>
</div>
<h1>welcome</h1>
