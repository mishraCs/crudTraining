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
var products = getProductCookie();
var productContainer = document.getElementById('product-container');

var cartPhp = 'cart.php';
if (window.location.href.includes(cartPhp)) {

    if (products.length > 0) {
        products.map(product => {
            const productCard = document.createElement('div');
            productCard.className = 'card mb-4 shadow-sm';
    
            const cardBody = document.createElement('div');
            cardBody.className = 'card-body text-center';
    
            const productImg = document.createElement('img');
            productImg.src = product.productImg;
            productImg.id = 'product-img';
            productImg.alt = 'Product Image';
            productImg.className = 'img-fluid mb-3 rounded';
    
            const productName = document.createElement('h5');
            productName.id = 'product-nm';
            productName.textContent = product.subCategoryName;
            productName.className = 'card-title'; 
    
            const productPrice = document.createElement('p');
            productPrice.id = 'product-rs';
            productPrice.textContent = `Price: ₹${product.subCategoryPrice}`;
            productPrice.className = 'card-text'; 
    
            const prodBtnCont = document.createElement('div');
            prodBtnCont.className = ' justify-content-between cart-btn'; 
    
            const RmvFrmCart = document.createElement('button');
            RmvFrmCart.id = 'RmvFrmCart';
            RmvFrmCart.className = 'btn btn-danger cart-crd-btn col-md-6';
            RmvFrmCart.textContent = 'Remove';
    
            const BuyProd = document.createElement('button');
            BuyProd.id = 'BuyProd';
            BuyProd.className = 'btn btn-primary cart-crd-btn col-md-6';
            BuyProd.textContent = 'Buy Now';
    
            cardBody.appendChild(productImg);
            cardBody.appendChild(productName);
            cardBody.appendChild(productPrice);
            prodBtnCont.appendChild(RmvFrmCart);
            prodBtnCont.appendChild(BuyProd);
    
            productCard.appendChild(cardBody);
            productCard.appendChild(prodBtnCont);
            productContainer.appendChild(productCard);
        }
    
    );
    
    } else {
        const productCard = document.createElement('div');
        productCard.className = 'card mt-5 col-md-4';
        productCard.style = "margin-right:auto;margin-left:auto;width: 800px;padding-top: 50px;padding-left: 100px;padding-right: 100px;padding-bottom: 100px;border-bottom-right-radius: 30px;box-shadow: 0px 2px 4px 0px #00000033;";
        const cardBody = document.createElement('div');
        cardBody.className = 'card-body';
    
        const productImg = document.createElement('img');
        productImg.src = "File/EmptyC.png";
        productImg.style = "height:300px; width:300px;";
    
        const emptyMessage = document.createElement('h4');
        emptyMessage.id = 'empty-mesg';
        emptyMessage.innerHTML = 'You have not added any <a href="index.php">products</a>';
        emptyMessage.style = "margin-top:50px; margin-bottom:-90px;";
    
        cardBody.appendChild(productImg);
        cardBody.appendChild(emptyMessage);
        productCard.appendChild(cardBody);
    
        productContainer.appendChild(productCard);
    }
}

