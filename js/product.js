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

  $("#login-form").submit(function (event) {
    event.preventDefault();
    const email = $("input[name='email']").val();
    const password = $("input[name='password']").val();
    loginUser(email, password);
  });
});

function loginUser(email, password) {
  // Hier kannst du den Code zum Anmelden des Benutzers implementieren
  // Zum Beispiel eine Ajax-Anfrage an den Server senden
  // und die Anmeldeinformationen überprüfen
  // Anschließend kannst du den Anmeldestatus in der Anzeige aktualisieren
  // Beispiel:
  $("#login-status").text("Sie sind mit dem Benutzer " + email + " angemeldet");
}
