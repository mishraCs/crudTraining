function clearformerror() {
    const errorElements = document.getElementsByClassName('form_error');
    for (let item of errorElements) {
        item.innerHTML = "";
    }
}
function seterror(id, error) {
    const element = document.getElementById(id);
    element.getElementsByClassName('form_error')[0].innerHTML = error;
}
function validateform() {
    let returnvalue = true;
    clearformerror();

    let name = document.forms['myForm']['first_name'].value;
    if (name.length > 35) {
        seterror("name", "Length of name is too long");
        returnvalue = false;
    }

    let last_name = document.forms['myForm']['last_name'].value;
    if (last_name.length > 35) {
        seterror("last_name", "Length of name is too long");
        returnvalue = false;
    }

    let email = document.forms['myForm']['email'].value;
    if (email.length > 70) {
        seterror("email", "Length of email is too long");
        returnvalue = false;
    }

    const password = document.forms['myForm']['password'].value;
    const pattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!pattern.test(password)) {
        if (!/(?=.*[A-Z])/.test(password)) {
            seterror("password_error", "Uppercase letter is required.");
        } else if (!/(?=.*[a-z])/.test(password)) {
            seterror("password_error", "Lowercase letter is required.");
        } else if (!/(?=.*\d)/.test(password)) {
            seterror("password_error", "Digit is required.");
        } else if (!/(?=.*[@$!%*?&])/.test(password)) {
            seterror("password_error", "Special symbol is required.");
        } else if (password.length < 8) {
            seterror("password_error", "Password must be at least 8 characters long.");
        }
        returnvalue = false;
    }

    const confirm_password = document.forms['myForm']['confirm_password'].value;
    if (password !== confirm_password) {
        seterror("confirm_password_error", "Password and confirm password must match.");
        returnvalue = false;
    } else if (!pattern.test(confirm_password)) {
        if (!/(?=.*[A-Z])/.test(confirm_password)) {
            seterror("confirm_password_error", "Uppercase letter is required.");
        } else if (!/(?=.*[a-z])/.test(confirm_password)) {
            seterror("confirm_password_error", "Lowercase letter is required.");
        } else if (!/(?=.*\d)/.test(confirm_password)) {
            seterror("confirm_password_error", "Digit is required.");
        } else if (!/(?=.*[@$!%*?&])/.test(confirm_password)) {
            seterror("confirm_password_error", "Special symbol is required.");
        } else if (confirm_password.length < 8) {
            seterror("confirm_password_error", "Password must be at least 8 characters long.");
        }
        returnvalue = false;
    }

    return returnvalue;
}
function showCategory(str) {
    if (str.length === 0) {
        document.getElementById("livesearch").innerHTML = "";
        document.getElementById("livesearch").style.border = "0px";
        return;
    }
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("livesearch").innerHTML = this.responseText;
            document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
        }
    };
    xmlhttp.open("GET", "livesearch.php?q=" + str, true);
    xmlhttp.send();
}
function viewSubCategory(str) {
    let xmlhttp = new XMLHttpRequest();  
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("viewSubCategory").innerHTML = this.responseText;
            document.getElementById("viewSubCategory").style.border = "1px solid #A5ACB2";
        }
    };
    xmlhttp.open("GET", "ViewSubCategory.php?q=" + str, true);
    xmlhttp.send();
}
function togglePermanentAddress() {
    const permanentFields = document.getElementById('permanent_address_fields');
    const checkbox = document.getElementById('same_as_permanent');
    if (checkbox.checked) {
        checkbox.style.display = 'none';
        permanentFields.style.display = 'block';
    } else {
        permanentFields.style.display = 'none';
    }
}
function validateForm() {
    const form = document.forms['purchaseForm'];
    const formData = new FormData(form);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'serverBuy.php', true);
    xhr.onload = function() {
        if (this.readyState === 4 && this.status === 200) {
            alert('Success');
        } else {
            alert('Failed');
        }
    };
    xhr.send(formData);
    return console.log('hello');
}
window.onload = function() {
    setTimeout(() => {
        $("#remove").hide(); 
    }, 7000);

    $('input').focus(function() {
        $(this).css('background-color', 'white'); 
    }).blur(function() {
        $(this).css('background-color', '#c3d0e6');
    });

    const btn = document.querySelector('#btn');
    const sidebar = document.querySelector('.sidebar');
    const searchBtn = document.querySelector('.bx-search');

    btn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });

    searchBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });

    if (!!location.href.match(/Home.php/)) {
        const temp = document.querySelector('#temp');
        const apik = "bc6e90e079477cfea6b91eb9053b9cc0";
        const convertion = (val) => (val - 273.15).toFixed(1); 

        fetch(`https://api.openweathermap.org/data/2.5/weather?q=India&appid=${apik}`)
            .then(res => res.json())
            .then(data => {
                const nameval = data['name'];
                const descrip = data['weather'][0]['description'];
                const tempature = data['main']['temp'];
                const wndspeed = data['wind']['speed'];

                temp.innerHTML = `Temp: <span>${convertion(tempature)} C</span>`;
            })
            .catch(err => console.log('You entered the wrong city name'));
    }

   
    if (document.getElementById("chk-avl")) {
        document.getElementById("chk-avl").addEventListener("click", function(event) {
            console.log('chk-avl');
        });
    }
};
document.addEventListener("DOMContentLoaded", function() {
    document.body.addEventListener("click", function(event) {
        if (event.target && event.target.id === "scroll-up") {
            window.scrollTo({
                top: document.body.scrollHeight, 
                behavior: 'smooth'  
            });
        }
    });
    document.body.addEventListener("click", function(event) {
        if (event.target && event.target.id === "chk-avl") {
            var subCategoryId = document.getElementById('subCategoryId').innerHTML;
            console.log(subCategoryId+"categoryId");
            window.location.href = 'BuyForm.php?subCategoryId='+subCategoryId;
        }
    });
    var dropdowns = document.querySelectorAll('.dropdown-submenu > div > a.test');
    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('click', function(event) {
            event.preventDefault(); 
            var submenu = this.nextElementSibling;
            if (submenu.classList.contains('show')) {
                submenu.classList.remove('show');
            } else {
                submenu.classList.add('show');
            }
            dropdowns.forEach(function(otherDropdown) {
                if (otherDropdown !== dropdown) {
                    var otherSubmenu = otherDropdown.nextElementSibling;
                    otherSubmenu.classList.remove('show');
                }
            });
        });
    });
    var dropdownToggle = document.querySelector('.dropdown-toggle');
    var dropdownMenu = document.querySelector('.dropdown-menu');

    dropdownToggle.addEventListener('click', function(event) {
        event.preventDefault(); 
        dropdownMenu.classList.toggle('show');
    });
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.dropdown')) {
            dropdownMenu.classList.remove('show');
        }
    });
});













