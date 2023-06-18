class ProductView {

    constructor(product) {
        this.product = product
    }

    createView(){
        const $divCol = $('<div class="col"></div>')
        const $divCard = $('<div class="card text-smaller"></div>')
        const $img = this.getImage()
        const $divCardBody = $('<div class="card-body"></div>')
        const $h5CardTitle = $('<h5 class="card-title">'+this.product.name.substring(0,10)+'</h5>')
        const $divCardText = $('<p class="card-text">'+this.product.name+'</p>')

        $divCard.append($img)
        $divCardBody.append($h5CardTitle)
        $divCardBody.append($divCardText)
        $divCard.append($divCardBody)

        return $divCol.append($divCard)
    }

    getImage() {
        return $("<img src='img/"+this.product.id+".png' />")
    }
}