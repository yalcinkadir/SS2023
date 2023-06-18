class ProductView {
    constructor(product, shoppingCart) { 
        this.product = product;
        this.shoppingCart = shoppingCart;
    }

    createView() {
        const $divCol = $('<div class="col"></div>');
        const $divCard = $('<div class="card text-smaller"></div>');
        const $img = this.getImage();
        const $divCardBody = $('<div class="card-body"></div>');
        const $h5CardTitle = $('<h5 class="card-title">'+this.product.name.substring(0,10)+'</h5>');
        const $divCardText = $('<p class="card-text">'+this.product.name+'</p>');
        const $button = $('<button>Add to cart</button>');
        
        // Define the action to take when the button is clicked.
        $button.on('click', () => {
            this.shoppingCart.addProduct(this.product);
        });
        
        $divCard.append($img);
        $divCardBody.append($h5CardTitle);
        $divCardBody.append($divCardText);
        $divCardBody.append($button); // Append the button to the card body.
        $divCard.append($divCardBody);

        return $divCol.append($divCard);
    }

    createProductItem(product) {
        console.log(product.name); // Add this line to log the product name
        const productView = new ProductView(product);
        return productView.createView();
    }
    

    getImage() {
        return $("<img src='img/"+this.product.id+".png' />");
    }
}
