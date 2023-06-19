class ProductsListView {
    constructor(productsListId) {
      this.productListUrl = null;
      this.$outputList = $('#' + productsListId);
      this.$errorMessage = $('#error-message-no-products');
      this.$cartButton = $('#cart-button');
    }
  
    setUrl(url) {
      this.productListUrl = url;
    }
  
    loadProducts() {
      if (this.productListUrl != null) {
        $.ajax(this.productListUrl)
          .done((response) => {
            this.$outputList.empty();
            if (response.products.length > 0) {
              this.$errorMessage.removeClass("show");
              for (const product of response.products) {
                this.$outputList.append(this.createProductItem(product));
              }
            } else {
              this.$errorMessage.addClass("show");
            }
            this.$cartButton.show(); // Show the cart button after loading products
          })
          .fail((xhr, status, error) => {
            console.log("Error: Failed to load products. " + error);
          });
      } else {
        console.log("Error: Invalid URL for Productslist: " + this.productListUrl);
      }
    }
  
    createProductItem(product) {
      const productView = new ProductView(product);
      return productView.createView();
    }
  }
  
  $(document).ready(function() {
    const productsListView = new ProductsListView("products-list");
    productsListView.setUrl(API_URL + "?action=listproductsbytypeid&typeId=1");
    productsListView.loadProducts();
  });
  