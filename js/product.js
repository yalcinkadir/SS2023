$(document).ready(function () {
  const $productsList = $("#products-list");
  const $errorMessage = $("#error-message-no-products");

  const productsListUrl = API_URL + "?action=listproductsbytypeid&typeId=1";

  loadProducts();

  function loadProducts() {
    $.getJSON(productsListUrl, function (data) {
      $productsList.empty();
      if (data.products.length > 0) {
        $errorMessage.removeClass("show");
        for (const product of data.products) {
          const productItem = createProductItem(product);
          $productsList.append(productItem);
        }
      } else {
        $errorMessage.addClass("show");
      }
    });

    const shoppingCart = new ShoppingCart();
    shoppingCart.updateCartDisplay();
  }

  function createProductItem(product) {
    const $productItem = $("<div>")
      .addClass("col mb-4")
      .append(
        $("<div>")
          .addClass("card")
          .append(
            $("<img>")
              .addClass("card-img-top")
              .attr("src", product.image)
              .attr("alt", product.name)
          )
          .append(
            $("<div>")
              .addClass("card-body")
              .append($("<h5>").addClass("card-title").text(product.name))
          )
      );
    return $productItem;
  }

  $("#cart-button").click(function () {
    $("#cart-modal").modal("show");
  });

});


