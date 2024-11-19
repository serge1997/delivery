<template>
    <NavbarComponent
        :menuitems="cart_items"
        @updateCartUi="getCartitems"
        :cart-item-quantity="cartItemQuantity"
    >
        <div class="container">
            <div class="row d-flex justify-content-between p-3 position-relative">
                <div class="col-md-6 mb-3" style="height: 410px;">
                    <div class="row">
                        <div class="col-md-6 d-flex flex-column mt-3">
                            <label class="form-label">Nom</label>
                            <InputText class="p-1" placeholder="Nom inscrit sur la carte" />
                        </div>
                        <div class="col-md-6 d-flex flex-column mt-3">
                            <label class="form-label">Numero de carte</label>
                            <InputMask class="p-1" mask="999.999.999.99" placeholder="000.000.000.00" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex flex-column mt-3">
                            <label class="form-label">Expiration</label>
                            <el-date-picker
                                class="w-100"
                                type="date"
                                placeholder="Date"
                                size="default"
                            />
                        </div>
                        <div class="col-md-3 d-flex flex-column mt-3">
                            <label class="form-label">Code Cvv</label>
                            <InputMask class="p-1" mask="999" placeholder="000" />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 p-3">
                            <Button label="Confirmez le paiement" class="rounded-pill w-100" />
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mb-3">
                    <CartSidebarComponent
                        :menuitems="Cart.get()"
                        @remove-from-cart="removeItemFromCart"
                    />
                </div>
            </div>
        </div>
    </NavbarComponent>
</template>
<script>
import CartSidebarComponent from '../../components/Order/CartSidebarComponent.vue';
export default {
    name: 'Checkout',
    components: {
        CartSidebarComponent
    },
    data(){
        return {
            cart_items: null,
            cartItemQuantity: null
        }
    },
    methods: {
        getCartitems(){
            if (this.Cart.getItemsIds()){
                this.cart_items = this.Cart.get();
                this.cartItemQuantity = this.Cart.count();
            }
        },
        removeItemFromCart(id){
            this.Cart.remove(id);
            this.getCartitems();
        },
    },
    mounted(){
        this.getCartitems();
    }
}
</script>
