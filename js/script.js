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
    window.onload = function() { // fetch weather data
        var temp = document.querySelector('#temp') 
        // var wind = document.querySelector('#wind')
        apik ="bc6e90e079477cfea6b91eb9053b9cc0"
        function convertion(val)
        {
        return (val - 273).toFixed(3)
        }
            fetch('https://api.openweathermap.org/data/2.5/weather?q=India&appid='+apik)
        .then(res => res.json())

        .then(data =>
            {
                var nameval = data['name']
                var descrip = data['weather']['0']['description']
                var tempature = data['main']['temp']
                var wndspeed = data['wind']['speed']

                // city.innerHTML=`Weather of <span>${nameval}<span>`
                temp.innerHTML = `Temp: <span>${convertion (tempature)} C</span>`
                // description.innerHTML=`Sky Conditions: <span>${descrip}<span>`
                // wind.innerHTML = `Wind Speed: <span>${wndspeed} km/h<span>`

        })
        
        .catch(err => console.log('You entered wrong city name'));
    }; 
    // Search at sidebar name="sideCategorySearch"
    function showCategory(str) {
        if (str.length==0) {
          document.getElementById("livesearch").innerHTML="";
          document.getElementById("livesearch").style.border="0px";
          return;
        }
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
          }
        }
        xmlhttp.open("GET","livesearch.php?q="+str,true);
        xmlhttp.send();
      }
      
    

       




