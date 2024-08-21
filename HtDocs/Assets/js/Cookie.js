function IndependenseDayPopup(){
    $('#DayPopup').modal('show');
}

function showSuccessModal(){
        $('#successModal').modal('show');
}
function alreadySuccessModal(){
        $('#already-add').modal('show');
}
function getProductCookie() {
    const cookieString = document.cookie;
    const cookies = cookieString.split('; ');

    let productCookie = cookies.find(row => row.startsWith('product='));
    if (productCookie) {
        productCookie = productCookie.split('=')[1];
        return JSON.parse(productCookie);
    }
    return [];
}
function addAsCookie() {
    alert('Index category add to cookie');
    var subCategoryId = document.getElementById('subCategoryId').innerHTML;
    subCategoryId = "subCategoryId" + subCategoryId;
    const productImg = document.getElementById('sub_category_img').src;
    const subCategoryName = document.getElementById('sub_category_name').innerHTML;
    const subCategoryPrice = document.getElementById('sub_category_price').innerHTML;
    var productss = getProductCookie();
    const existingProduct = productss.find(product => product.productImg === productImg);
    if (existingProduct) {
        alreadySuccessModal();
        console.log('Product already added');
        return;
    } 
    const d = new Date();
    const exdays = 2;
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    const expires = "expires=" + d.toUTCString();

    const newProduct = {
        productImg: productImg,
        subCategoryName: subCategoryName,
        subCategoryPrice: subCategoryPrice
    };

    let products = [];
    const existingCookie = document.cookie.split('; ').find(row => row.startsWith('product='));
    if (existingCookie) {
        const existingValue = existingCookie.split('=')[1];
        products = JSON.parse(existingValue);
    }

    products.push(newProduct);

    const subCatJson = JSON.stringify(products);
    showSuccessModal();
    document.cookie = `product=${subCatJson}; ${expires}; path=/`;
}

// BuyForm Input value
const searchString = 'BuyForm.php';
if (window.location.href.includes(searchString)) {
    var FrstNm = document.getElementById('first_name').value;
    if (FrstNm !== '') {
            alert('hello buyer');
        var InputValue = {};
        var InputValueFile = {};
        $('#BuyForm').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            formData.forEach(function(value, key) {
                if (typeof value === "string") {
                    InputValue[key] = value;
                }
            });
            $('#UserForm input[type="file"]').each(function() {
                var fileInput = $(this)[0];
                if (fileInput.files.length > 0) {
                    InputValueFile[fileInput.name] = fileInput.files[0].name;
                }
            });
        });
        console.log(InputValue);
        console.log(InputValueFile);
    }
} else {
    console.log('String not found in URL');
}
// BuyForm Input value








