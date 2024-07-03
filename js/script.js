    function clearformerror(){
        error = document.getElementsByClassName('form_error');
        for(let item of error){
            return item.innerHTML = "";
        }
    }
    function seterror(id, error){
        element = document.getElementById(id);
        element.getElementsByClassName('form_error')[0].innerHTML = error;
    }
    function validateform(){

        var returnvalue = true;
        clearformerror();
        let name = document.forms['myForm']['first_name'].value;
        if(name.length >35 ){
                seterror("name", "Length of name is too Long");
                returnvalue = false; 
        }

        let last_name = document.forms['myForm']['last_name'].value;
        if(last_name.length > 35 ){
                seterror("last_name", "Length of name is too short");
                returnvalue = false; 
        }
        var email = document.forms['myForm']['email'].value;
        if(email.length >70 ){
                seterror("email", "Length of email is too long");
                returnvalue = false; 
        }

        // password
        const password = document.forms['myForm']['password'].value;
        const pattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!pattern.test(password)) {
            if (!/(?=.*[A-Z])/.test(password)) {
                seterror("password_error", "Uppercase letter is required.");
                returnvalue = false;
                return returnvalue;
            }
            if (!/(?=.*[a-z])/.test(password)) {
                seterror("password_error", "Lowercase letter is required.");
                returnvalue = false;
                return returnvalue;
            }
            if (!/(?=.*\d)/.test(password)) {
                seterror("password_error", "Digit is required.");
                returnvalue = false;
                return returnvalue;
            }
            if (!/(?=.*[@$!%*?&])/.test(password)) {
                seterror("password_error", "Special symbol is required.");
                returnvalue = false;
                return returnvalue;
            }
            console.log("passwrod len:",password.length);
            if (password.length < 8) {
                seterror("password_error", "Password must be at least 8 characters long.");
                returnvalue = false;
                return returnvalue;
            }
            returnvalue = false;
        }
        const confirm_password = document.forms['myForm']['confirm_password'].value;
        if (!pattern.test(confirm_password)) {
            if (!/(?=.*[A-Z])/.test(password)) {
                seterror("confirm_password_error", "Uppercase letter is required.");
                returnvalue = false;
                return returnvalue;
            }
            if (!/(?=.*[a-z])/.test(confirm_password)) {
                seterror("confirm_password_error", "Lowercase letter is required.");
                returnvalue = false;
                return returnvalue;
            }
            if (!/(?=.*\d)/.test(confirm_password)) {
                seterror("confirm_password_error", "Digit is required.");
                returnvalue = false;
                return returnvalue;
            }
            if (!/(?=.*[@$!%*?&])/.test(confirm_password)) {
                seterror("confirm_password_error", "Special symbol is required.");
                returnvalue = false;
                return returnvalue;
            }
            if (confirm_password.length < 8) {
                seterror("confirm_password_error", "Password must be at least 8 characters long.");
                returnvalue = false;
                return returnvalue;
            }
           
            return returnvalue;
        }
        if(password !== confirm_password){
                seterror("confirm_password_error", "Passwrod and Confirm_passwrod both field should match");
                returnvalue = false;
                return returnvalue;
            }

        // delete_profile_erro
        

      return returnvalue;
    }
    window.onload = function() {
        setTimeout(() => {
            $( "#remove" ).hide();
            // Redirect to the specified URL after 5 seconds
            // window.location.href = "http://localhost/MyCode/CRUD/dashboard.php";
        }, 7000);
    };   

    let btn = document.querySelector('#btn');
    let sidebar = document.querySelector('.sidebar');
    let searchBtn = document.querySelector('.bx-search');

    btn.addEventListener('click', () => {
    sidebar.classList.toggle('active');
    });

    searchBtn.addEventListener('click', () => {
    sidebar.classList.toggle('active');
    });
    window.onload = function() {
        console.log("hello");
    };  
    
    

       




