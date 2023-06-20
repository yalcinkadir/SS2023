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
            console.log(response);
            this.$outputList.append(response);
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
            this.$cartButton.click(() => {
                // soyle yapalim ben todolar yazyim sen olustur tanam sonra yarin sabah yine ben bakayim 
                // ama gece yap sabah erkenden bakacagim ok

            });

          })
          .fail((xhr, status, error) => {
            console.log("Error: Failed to load products. " + error);
          });
      } else {
        console.log("Error: Invalid URL for Productslist: " + this.productListUrl);
      }
    }
  
    createProductItem(product) {

      const shoppingCart = new ShoppingCart();
      const productView = new ProductView(product, shoppingCart); // TODO: Constructor eksik card icin orada da
      return productView.createView();
    }
  }
  
  /*$(document).ready(function() {
    const productsListView = new ProductsListView("products-list");
    productsListView.setUrl(API_URL + "?action=listproductsbytypeid&typeId=1");
    productsListView.loadProducts();
  });
   */