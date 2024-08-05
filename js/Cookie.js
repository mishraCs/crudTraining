var formData = {};
const myPaths = "localhost/MyCode/CRUD/sub_category_view.php;localhost/MyCode/CRUD/update_work.php";

function addAsCookie() {
    var subCategoryId = document.getElementById('subCategoryId').innerHTML;
    subCategoryId = "subCategoryId" + subCategoryId;
    const productImg = document.getElementById('sub_category_id').src;
    const subCategoryName = document.getElementById('sub_category_name').innerHTML;
    const subCategoryPrice = document.getElementById('sub_category_price').innerHTML;
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

    document.cookie = `product=${subCatJson}; ${expires}; path=/`;
}









