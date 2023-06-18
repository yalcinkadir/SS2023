$(document).ready(function() {
    let listTypesUrl = "api/?action=listTypes"
    //let productListUrl  = "api/?action=listProductsByTypeId&typeId="
    let productListView = new ProductsListView('products-list')
    let productTypesView = new ProductTypesView(listTypesUrl, "types-list", productListView)
    productTypesView.drawListGroup()
})