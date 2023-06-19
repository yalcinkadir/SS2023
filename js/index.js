// JavaScript-Code in index.js

$(document).ready(function() {
  // Erstelle eine Instanz der ProductTypesView
  const productTypesView = new ProductTypesView("types-list");

  // Erstelle eine Instanz der ProductsListView
  const productsListView = new ProductsListView("products-list");

  // Setze die URLs für die Produkttypen und Produkte
  productTypesView.setUrl(API_URL + "?action=listtypes");
  productsListView.setUrl(API_URL + "?action=listproductsbytypeid&typeId=1");

  // Lade die Produkttypen und Produkte
  productTypesView.loadProductTypes();
  productsListView.loadProducts();

  // Füge einen Klick-Eventhandler für den Warenkorb-Button hinzu
  $("#cart-button").click(function() {
    // Öffne das Warenkorb-Modal
    $("#cart-modal").modal("show");
  });

  // Füge einen Submit-Eventhandler für das Anmeldeformular hinzu
  $("#login-form").submit(function(event) {
    event.preventDefault();
    const email = $("input[name='email']").val();
    const password = $("input[name='password']").val();
    // Führe die Anmeldeaktion aus
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
