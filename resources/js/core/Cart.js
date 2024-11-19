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

    save(item_id, item_quantity, item_name, item_price, item_image = null, sidedish = null, reduce_quantity = false){
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
                    price: item_price.replaceAll(/\D/g, ''),
                    image: item_image,
                    item_total: item_price.replaceAll(/\D/g, ''),
                    side_dishes: []
                })
            }
            localStorage.setItem('cart', JSON.stringify(cartElements));
            if (sidedish){
                this.addSideDish({id: item_id}, sidedish);
            }
        }else{
            this.cart = [];
            this.cart.push({
                id: item_id,
                quantity: item_quantity,
                name: item_name,
                price: item_price.replaceAll(/\D/g, ''),
                image: item_image,
                item_total: item_price.replaceAll(/\D/g, ''),
                side_dishes: []
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
    hasItem(item){
        const find = this.findItem(item);

        return find ? true : false;
    }
    findItem(item){
        const cartElements = this.get();
        let finded = null;
        if (cartElements.length){
            finded = cartElements.find(el => el.id == item.id);
        }
        return finded;
    }
    hasSideDish(item, sidedish){
        const finded = this.findItem(item);
        let exists = null;
        if (finded && finded.side_dishes.length){
            finded.side_dishes.forEach(el => {
                if (el.id == sidedish. id){
                    exists = true;
                }
            })
        }
        return exists ? true : false;
    }
    addSideDish(item, sidish = null){
        if (this.get().length){
            const cartElements = this.get();
            cartElements.forEach((el, index) => {
                if (el.id == item.id){

                    if (cartElements[index].side_dishes.length){
                        cartElements[index].side_dishes.forEach((side, ind) => {
                            cartElements[index].side_dishes[ind].quantity = cartElements[index].quantity;
                            cartElements[index].side_dishes[ind].total = cartElements[index].quantity * cartElements[index].side_dishes[ind].price.replaceAll(/\D/g, '');
                        })
                    }else{
                        if(sidish){
                            cartElements[index].side_dishes.push({
                                name: sidish.side_dish_name,
                                price: sidish.price,
                                quantity: 1,
                                total: sidish.price,
                                id: sidish.id
                            })
                        }
                    }
                }
            })
            localStorage.setItem('cart', JSON.stringify(cartElements));
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
