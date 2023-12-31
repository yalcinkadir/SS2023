class ProductTypesView {
  constructor(url, outputListId, productListView) {
    this.url = url;
    this.$outputList = $("#" + outputListId);
    this.productListView = productListView;
    this.typeItems = [];
  }

  setUrl(url) {
    this.url = url;
  }

  drawListGroup() {
    $.ajax(this.url)
      .done((response) => {
        for (const item of response) {
          this.$outputList.append(this.createListEntry(item));
        }
        this.typeItems[0].trigger("click");
      })
      .fail((error) => {
        console.log("Ajax Call failed: ", error);
      });
  }

  createListEntry(productTypesItem) {
    console.log("createEntriy");
    let $listEntry = $("<li>" + productTypesItem.productType + "</li>");
    $listEntry.addClass("list-group-item");
    $listEntry.addClass("cursor-pointer");
    $listEntry.addClass("list-group-item-action");

    $listEntry.on("click", () => {
      this.$outputList.find(".list-group-item").removeClass("active");
      $listEntry.addClass("active");

      this.productListView.setUrl(productTypesItem.url);
      this.productListView.loadProducts();
    });

    this.typeItems.push($listEntry);
    return $listEntry;
  }
}

/* $(document).ready(function () {
   const productTypesView = new ProductTypesView(API_URL + "?action=listtypes", "types-list", productsListView);
   productTypesView.drawListGroup();
 }); */