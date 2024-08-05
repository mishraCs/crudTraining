var formData = {};
const myPaths = "localhost/MyCode/CRUD/sub_category_view.php;localhost/MyCode/CRUD/update_work.php";

function addAsCookie() {
    const productImg = document.getElementById('sub_category_id').src;
    const subCategoryName = document.getElementById('sub_category_name').innerHTML;
    const subCategoryPrice = document.getElementById('sub_category_price').innerHTML;
    const d = new Date();
    const exdays = 2;
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    const expires = "expires=" + d.toUTCString();
    
    const subCatJson = JSON.stringify({
        productImg: productImg,
        subCategoryName: subCategoryName,
        subCategoryPrice: subCategoryPrice
    });
    
    document.cookie = `Product=${subCatJson}; ${expires}; path=${myPaths}`;
}

function getCookie(cname) {
    const name = cname + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i].trim();
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function getCookieValue() {
    const currentLocation = window.location.href;
    if (currentLocation.includes('cart')) {
        const cookieValue = document.cookie
            .split('; ')
            .find(row => row.startsWith('Product='))
            .split('=')[1];
        const retrievedObject = JSON.parse(cookieValue);        
        for (const key in retrievedObject) {
            if (retrievedObject.hasOwnProperty(key)) {
                const value = retrievedObject[key];
                console.log(value);
                formData[key] = value;
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    getCookieValue();
});

jQuery($ => {
    // const productInfo = new FormData();
    // productInfo.append("productInfo", JSON.stringify(formData));
    // console.log(json.decode(productInfo));
    $.ajax({
        type: "POST",
        url: "cart.php",
        data: "productInfo",
        // contentType: false,
        // processData: false,
        success: function(response) {
            if (response) {
                alert(response);
                console.log('Response received:', response);
            } else {
                console.log('Denied...');
            }
        }
    });
});
