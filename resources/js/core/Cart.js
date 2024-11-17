export class Cart{
    constructor(){
        this.id = null;
        this.quantity = null;
        this.name = null;
        this.image = null;
        this.price = null;
        this.item_total = null;
        this.cart = [];
        this.items_ids = new Set();
    }

    save(item_id, item_quantity, item_name, item_price, item_image = null, reduce_quantity = false){
        this.item_id = item_id,
        this.item_quantity = item_quantity;
        const cartElements = this.get();
        if (cartElements.length){
            cartElements.forEach((el, index) => {
                this.items_ids.add(el.id);
                if (item_id == el.id){
                    if (!reduce_quantity){
                        cartElements[index].quantity += 1;
                        cartElements[index].item_total = cartElements[index].price.replaceAll(/\D/g, '') * cartElements[index].quantity
                    }else{
                        if (cartElements[index].quantity > 1){
                            cartElements[index].quantity -= 1;
                            cartElements[index].item_total = cartElements[index].price.replaceAll(/\D/g, '') * cartElements[index].quantity
                        }
                    }
                }
            })
            if (!this.items_ids.has(item_id)){
                cartElements.push({
                    id: item_id,
                    quantity: item_quantity,
                    name: item_name,
                    price: item_price,
                    image: item_image,
                    item_total: item_price
                })
            }
            localStorage.setItem('cart', JSON.stringify(cartElements));
        }else{
            this.cart = [];
            this.cart.push({
                id: item_id,
                quantity: item_quantity,
                name: item_name,
                price: item_price,
                image: item_image,
                item_total: item_price
            });
            localStorage.setItem('cart', JSON.stringify(this.cart));
        }
    }

    get(){
        if (localStorage.getItem('cart')){
            return JSON.parse(localStorage.getItem('cart'));
        }
        return [];
    }
    count(){
        if(this.get()){
            return this.get().length;
        }
    }
    getItemsIds(){
        const cartElements = this.get();
        let ids = [];
      if (cartElements){
        cartElements.forEach((el, index) => {
            ids.push(el.id);
        })
        return ids;
      }
    }
    remove(item_id){
        if (this.get().length && item_id){
            const elements = this.get();
            elements.forEach((el, index) => {
                if (el.id == item_id){
                    elements.splice(index, 1);
                }
            })
            this.items_ids.delete(item_id)
            localStorage.setItem('cart', JSON.stringify(elements));
        }
    }
}
