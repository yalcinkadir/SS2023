class ProductsListView {
    constructor(productsListId) {
        this.productListUrl = null
        this.$outputList = $('#' + productsListId)
        this.$errorMessage = $('#error-message-no-products')
    }
    setUrl(url) {
        this.productListUrl = url
    }
    loadProducts() {
        if (this.productListUrl != null) {
            $.ajax(this.productListUrl)
                .done((response) => {
                    this.$outputList.empty()
                    if(response.products.length > 0) {
                        this.$errorMessage.removeClass("show")
                        for (const product of response.products) {
                            this.$outputList.append(this.createProductItem(product))
                        }
                    } else {
                        this.$errorMessage.addClass("show")
                    }
                })
        } else {
            console.log("Error: Invalid URL for Productslist: " + this.productListUrl)
        }
    }
    createProductItem(product) {
        const productView = new ProductView(product)
        return productView.createView()
    }
}