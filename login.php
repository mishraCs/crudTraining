<?php
ob_start();
include 'helper/header.php'; 
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}
$login = new VerifyUser;
if(isset($_GET['email']) && isset($_GET['active'])){
    $result = $login->verify_email($conn);
    if(isset($result)){
        ?> <div class="alert alert-danger" role="alert">
        <?php echo $result."<br>"; ?>
      </div> <?php
    }
}
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
   $result =  $login->login($conn);
   if(isset($result)){
        ?> <div class="alert alert-danger" role="alert">
        <?php echo $result."<br>"; ?>
    </div> <?php
    }
}
?>
<div class=" form_div ">
    <h2>Login Form</h2>
    <form class="form-group" method="post" name="usrForm" id="UserForm">
        <label for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email" required><br>
        <label for="password">Password:</label>
        <input class="form-control" type="password" id="password" name="password" required><br>
    </form>
    <? //xml version="1.0" encoding="iso-8859-1"?>
    <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
    <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
    <svg onclick="inputFun()" fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
        width="80px" height="80px" viewBox="0 0 551.057 551.057"
        xml:space="preserve">
        <g>
            <g>
                <path d="M127.657,325.149h98.997v98.997c0,12.46,10.098,22.559,22.559,22.559h52.632c12.46,0,22.558-10.099,22.558-22.559v-98.997
                    h98.997c12.461,0,22.559-10.098,22.559-22.559v-52.632c0-12.46-10.098-22.559-22.559-22.559h-98.997v-98.997
                    c0-12.46-10.098-22.558-22.558-22.558h-52.632c-12.46,0-22.559,10.098-22.559,22.558V227.4h-98.997
                    c-12.46,0-22.558,10.098-22.558,22.559v52.632C105.099,315.052,115.197,325.149,127.657,325.149z"/>
                <path d="M477.685,0H73.373C32.913,0,0,32.913,0,73.373v404.312c0,40.459,32.913,73.372,73.373,73.372h404.312
                    c40.459,0,73.372-32.913,73.372-73.372V73.373C551.057,32.907,518.144,0,477.685,0z M459.257,459.257H91.8V91.8h367.463v367.457
                    H459.257z"/>
            </g>
        </g>
    </svg>
    <input type="hidden" id="addLabelIpt"  placeholder="Write your Document Name">
    <button style="display:none" id="addLb" onclick="addLblInpt()">Add</button>
    <button class="btn btn-primary" form="UserForm" name="submit" type="submit">Login</button>
</div>
 <?php include 'helper/footer.php';?>
<script>
    var formElements = document.usrForm.elements;
    var orig = formElements.length - 1;
    console.log(orig);
    for (var i = 0; i < formElements.length; i++) {
        var inputElement = formElements[i];
        var label = inputElement.labels[0].innerHTML;
        
        console.log(label);
    }
    function inputFun(){
        document.getElementById('addLabelIpt').type = "text";
        document.getElementById('addLb').display = "block";
        var x = document.getElementById("addLb");
        if (x.style.display === "none") {
            x.style.display = "block";
        }
    }
  
    function addLblInpt(){
        var addLabelIpt = document.getElementById('addLabelIpt').value;
        alert(addLabelIpt);
            inputName = addLabelIpt+"Name";
            inputId = addLabelIpt+"Id";

        var phoneInput = document.createElement('input');
            phoneInput.id = inputId;
            phoneInput.name = addLabelIpt;
            phoneInput.type = "file";

        var formElements = document.usrForm.elements;
        var valadfg = formElements.length;
        cosole.log(valadfg);
        for (var i = 0; i < formElements.length; i++) {
            var inputElement = document.usrForm.elements[i];
            var label = inputElement.labels[0].innerHTML;
            if(label === addLabelIpt){
               return document.write('label already exists');
            }
        }

        for (var i = 0; i < formElements.length; i++) {
            var inputElement = document.usrForm.elements[i];
            var label = inputElement.labels[0].innerHTML;
            if(label === inputName){
               return document.write('label already exists');
            }
        }


        var phoneLabel = document.createElement('label');
            phoneLabel.setAttribute('for', 'phone1');
            phoneLabel.innerHTML = inputName;

        var UserForm = document.getElementById('UserForm'); // Replace 'myForm' with your form ID
            UserForm.appendChild(phoneLabel);
            UserForm.appendChild(phoneInput);


    }
 </script>
