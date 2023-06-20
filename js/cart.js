class ShoppingCart {
  constructor() {

  }

  addProduct(product) {

    const products = JSON.parse(window.sessionStorage.getItem('products'));
    console.log(this.products);
    products.push(product.name);

    window.sessionStorage.setItem('products', JSON.stringify(products));
    console.log("Product added to the shopping cart:", product);

  }

  removeProduct(product) {
    let products = JSON.parse(window.sessionStorage.getItem('products')) || [];
    const index = products.indexOf(product);
    if (index !== -1) {
      products.splice(index, 1);
      console.log("Product removed from the shopping cart:", product);
      window.sessionStorage.setItem('products', JSON.stringify(products));
      this.updateCartDisplay(); // Aktualisiere die Anzeige des Warenkorbs
    }
  }

  updateCartDisplay() {
    const $cartItemsList = $("#cart-items-list");
    $cartItemsList.empty();

    const products = JSON.parse(window.sessionStorage.getItem('products'));
    if (products && products.length > 0) {
      for (const product of products) {
        const $productItem = this.createCartItemElement(product);
        $cartItemsList.append($productItem);
      }
    } else {
      $cartItemsList.append('<li>Der Warenkorb ist leer.</li>');
    }
  }

  createCartItemElement(product) {
    const $productItem = $("<li>").addClass("cart-item");
    const $counter = $("<span>").addClass("counter").text("1");
    const $incrementButton = $("<button>").addClass("increment").text("+");
    const $decrementButton = $("<button>").addClass("decrement").text("-");

    $incrementButton.on("click", () => {
      const currentCount = parseInt($counter.text());
      $counter.text(currentCount + 1);
    });

    $decrementButton.on("click", () => {
      console.log("Decrement button clicked");
      const currentCount = parseInt($counter.text());
      if (currentCount > 1) {

        $counter.text(currentCount - 1);
      } else {
        this.shoppingCart.removeProduct(product); // Produkt entfernen, wenn der Zähler 1 erreicht
      }
    });

    $productItem.append($decrementButton, $counter, $incrementButton, product);
    return $productItem;
  }

  clearCart() {
    window.sessionStorage.removeItem('products');
    console.log("Der Warenkorb wurde geleert.");
    this.updateCartDisplay();
  }

}