class ProductTypesView {
    constructor(typesListId) {
      this.typesListUrl = null;
      this.$typesList = $("#" + typesListId);
    }
  
    setUrl(url) {
      this.typesListUrl = url;
    }
  
    loadProductTypes() {
      if (this.typesListUrl != null) {
        $.getJSON(this.typesListUrl, (data) => {
          this.$typesList.empty();
          if (data.length > 0) {
            for (const item of data) {
              const button = $("<button>")
                .addClass("list-group-item list-group-item-action")
                .text(item.name)
                .click(() => {
                  this.highlightButton(button);
                  this.loadProducts(item.url);
                });
              this.$typesList.append(button);
            }
            // Lade standardmäßig die Produkte des ersten Produkttyps
            const firstButton = this.$typesList.children().first();
            this.highlightButton(firstButton);
            this.loadProducts(firstButton.attr("data-url"));
          } else {
            this.$typesList.text("Keine Produkttypen gefunden.");
          }
        });
      } else {
        console.log("Fehler: Ungültige URL für Produkttypenliste: " + this.typesListUrl);
      }
    }
  
    highlightButton(button) {
      this.$typesList.children().removeClass("active");
      button.addClass("active");
    }
  
    loadProducts(url) {
      // Hier kannst du den Code zum Laden der Produkte implementieren
      // Zum Beispiel eine Ajax-Anfrage an den Server senden
      // und die Produkte basierend auf der URL abrufen
      // Anschließend kannst du die Produkte in der Produktauflistung anzeigen
      console.log("Lade Produkte von URL: " + url);
    }
  }
  
  class ProductsListView {
    constructor(productsListId) {
      this.productsListUrl = null;
      this.$productsList = $("#" + productsListId);
      this.$errorMessage = $("#error-message-no-products");
    }
  
    setUrl(url) {
      this.productsListUrl = url;
    }
  
    loadProducts() {
      if (this.productsListUrl != null) {
        $.getJSON(this.productsListUrl, (data) => {
          this.$productsList.empty();
          if (data.products.length > 0) {
            this.$errorMessage.removeClass("show");
            for (const product of data.products) {
              const productItem = this.createProductItem(product);
              this.$productsList.append(productItem);
            }
          } else {
            this.$errorMessage.addClass("show");
          }
        });
      } else {
        console.log("Fehler: Ungültige URL für Produktliste: " + this.productsListUrl);
      }
    }
  
    createProductItem(product) {
      const productItem = $("<div>")
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
      return productItem;
    }
  }
  
  $(document).ready(function () {
    const productTypesView = new ProductTypesView("types-list");
    const productsListView = new ProductsListView("products-list");
  
    productTypesView.setUrl(API_URL + "?action=listtypes");
    productsListView.setUrl(API_URL + "?action=listproductsbytypeid&typeId=1");
  
    productTypesView.loadProductTypes();
    productsListView.loadProducts();
  
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