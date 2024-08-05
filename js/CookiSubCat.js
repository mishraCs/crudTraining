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

const products = getProductCookie();

const productContainer = document.getElementById('product-container');

if (products.length > 0) {
    products.forEach(product => {
        const productCard = document.createElement('div');
        productCard.className = 'card mt-5 col-md-4';

        const cardBody = document.createElement('div');
        cardBody.className = 'card-body';

        const productImg = document.createElement('img');
        productImg.src = product.productImg;
        productImg.id = 'product-img';
        productImg.alt = 'Product Image';

        const productName = document.createElement('h1');
        productName.id = 'product-nm';
        productName.textContent = `Name: ${product.subCategoryName}`;

        const productPrice = document.createElement('h1');
        productPrice.id = 'product-rs';
        productPrice.textContent = `Price: ${product.subCategoryPrice}`;

        cardBody.appendChild(productImg);
        cardBody.appendChild(productName);
        cardBody.appendChild(productPrice);

        productCard.appendChild(cardBody);

        productContainer.appendChild(productCard);
    });
} else {
    const noProductsMessage = document.createElement('p');
    noProductsMessage.textContent = 'No products available.';
    productContainer.appendChild(noProductsMessage);
}