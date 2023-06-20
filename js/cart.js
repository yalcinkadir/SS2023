class ShoppingCart {
  constructor() {

  }

  addProduct(product) {

    const products =  JSON.parse(window.sessionStorage.getItem('products')  );
    console.log(this.products);
    products.push(product.name);

    window.sessionStorage.setItem('products',JSON.stringify( products));
    console.log("Product added to the shopping cart:", product);
    // Hier kannst du weitere Aktionen ausführen, z.B. die Anzeige aktualisieren
  }

  removeProduct(product) {

    const products = window.sessionStorage.getItem('products');
    const index = products.indexOf(product);
    if (index !== -1) {
      products.splice(index, 1);
      console.log("Product removed from the shopping cart:", product);
      // Hier kannst du weitere Aktionen ausführen, z.B. die Anzeige aktualisieren
    }
  }
}

