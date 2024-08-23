function ProfilePopup() {
    $('#Profile').modal('show');
    console.log('profile');
}
function showSuccessModal() {
    $('#successModal').modal('show');
}
function alreadySuccessModal() {
    $('#already-add').modal('show');
}
function getProductCookie() {
    const cookieString = document.cookie;
    const cookies = cookieString.split('; ');
    let productCookie = cookies.find(row => row.startsWith('product='));
    if (productCookie) {
        productCookie = productCookie.split('=')[1];
        return JSON.parse(decodeURIComponent(productCookie));
    }
    return [];
}
function addAsCookie() {
    alert("addAsCookie function called");
    var subCategoryId = document.getElementById('subCategoryId').innerHTML;
    subCategoryId = "subCategoryId" + subCategoryId;
    const productImg = document.getElementById('sub_category_img').src;
    const subCategoryName = document.getElementById('sub_category_name').innerHTML;
    const subCategoryPrice = document.getElementById('sub_category_price').innerHTML;
    var products = getProductCookie();
    if (products.length > 0) {
        const existingProduct = products.find(product => product.productImg === productImg);
        if (existingProduct) {
            alreadySuccessModal();
            console.log('Product already added');
            return;
        }
    }
    const newProduct = {
        productId: productId,
        productImg: productImg,
        subCategoryName: subCategoryName,
        subCategoryPrice: subCategoryPrice
    };
    products.push(newProduct);
    const d = new Date();
    const exdays = 2;
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    const expires = "expires=" + d.toUTCString();
    const subCatJson = JSON.stringify(products);
    document.cookie = `product=${subCatJson}; ${expires}; path=/`;
    showSuccessModal();
    console.log('Product added successfully');
}
function removeCookie(cookieName) {
    document.cookie = `${cookieName}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
}
function removeAsCookie(name) {
    alert("removeAsCookie function called");
    let products = [];
    const existingCookie = document.cookie.split('; ').find(row => row.startsWith('product='));
    if (existingCookie) {
        const existingValue = existingCookie.split('=')[1];
        products = JSON.parse(decodeURIComponent(existingValue));
        products.forEach(product => console.log(product.subCategoryName));
        console.log("the value of product name hp :"+name);
        console.log(products);
        const indexToRemove = products.findIndex(product => product.subCategoryName === name);
        alert("indexToRemove");
        if (indexToRemove !== -1) {
            alert('indexToRemove inner check');
            products.splice(indexToRemove, 1);
            console.log("Product removed successfully.");
            const updatedValue = encodeURIComponent(JSON.stringify(products));
            document.cookie = `product=${updatedValue}; path=/;`;
            console.log("Cookie updated with the new products array.");
        } else {
            console.log("Product not found in the array.");
        }
    } else {
        console.log("No existing cookie found.");
    }

}
