<template>
    <div class="container-fluid p-0">
        <div class="w-100">
            <el-menu class="navbar-el-menu border-bottom d-flex justify-content-between p-0">
            <div class="shadow-sm d-flex gap-2 p-0 el-menu-iem-box">
                    <div class="w-25 d-flex">
                        <el-menu-item class="d-flex">
                            <SidebarComponent />
                        </el-menu-item>
                        <el-menu-item index="1" class="text-dark">
                            <router-link class="text-dark text-decoration-none" to="/">LOGO</router-link>
                        </el-menu-item>
                    </div>
                    <div class="p-0 w-75 d-flex">
                        <el-menu-item class="p-0 w-100" index="1">
                            <el-input v-model="input" placeholder="Please input" />
                        </el-menu-item>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="button-box cart-box-button">
                        <Button @click="cartVisibleSidebar = true" text icon="pi pi-cart-arrow-down" :label="cartItemQuantity ?? Cart.count()"/>
                    </div>
                    <div v-if="!isAuthenticated" class="button-box">
                        <Button @click="visibleCustomerLoginModal = true" class="d-flex gap-2" text>
                            <span><i class="pi pi-user"></i></span>
                            <span>Login</span>
                        </Button>
                    </div>
                    <div v-else class="button-box">
                        <Button @click="logout" class="d-flex gap-2 text-danger" text>
                            <span><i class="pi pi-sign-out"></i></span>
                        </Button>
                    </div>
                </div>
            </el-menu>
            <Sidebar class="cart_side_bar p-0" v-model:visible="cartVisibleSidebar" header="Votre panier" position="right">
                <CartSidebarComponent
                    :cart-item-quantity="cartItemQuantity"
                    :menuitems="menuitems"
                    @remove-from-cart="removeItemFromCart"
                    @increment-cart-item-quantity="addToCart"
                    @reduce-cart-item-quantity="reduceCartItemQuantity"
                    :is-for-cart-actions="true"
                />
            </Sidebar>
            <Dialog v-model:visible="visibleCustomerLoginModal" modal header="Bienvenue !" :style="{ width: '25rem' }">
                <CustomerLoginComponent />
            </Dialog>
        </div>
        <div class="w-100 mt-3">
            <slot></slot>
        </div>
    </div>
</template>
<script>
import SidebarComponent from './SidebarComponent.vue';
import CartSidebarComponent from './Order/CartSidebarComponent.vue';
import { defineAsyncComponent } from 'vue';
export default {
    inject: ['isAuthenticated'],
    name: 'NavbarComponent',

    props: {
        menuitems: Object,
        cartItemQuantity: Number
    },

    components: {
        SidebarComponent,
        CartSidebarComponent,
        CustomerLoginComponent: defineAsyncComponent(() =>
            import('../Pages/Auth/CustomerLoginComponent.vue')
        )
    },

    data(){
        return {
            input: null,
            navbarItems: [
                {
                    label: 'Home',
                    icon: 'pi pi-home'
                },
                {
                    label: 'Features',
                    icon: 'pi pi-star'
                },
            ],
            cartVisibleSidebar: false,
            cart_items: null,
            visibleCustomerLoginModal: false
        }
    },
    methods: {
        logout(){
            const url = this.Auth.logoutURL();
            this.Api.post(url)
            .then(async response => {
                this.Auth.logout();
                location.reload()
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        },
        addToCart(item){
            this.Cart.save(item.id, 1, item.name, item.price, item.image, this.side_dihes);
            this.Cart.addSideDish(item, this.side_dihes);
            this.getCartitems();
            this.visibleShowMenuitemModal = false;
            this.side_dihes = null;
            this.$emit('updateCartUi')
        },
        getCartitems(){
            if (this.Cart.getItemsIds()){
                this.cart_items = this.Cart.get();
            }
        },
        removeItemFromCart(id){
            this.Cart.remove(id);
            this.$emit('updateCartUi')
        },
        reduceCartItemQuantity(item){
            this.Cart.save(item.id, 1, item.name, item.price, item.image, true, true);
            this.getCartitems();
            this.$emit('updateCartUi')
        },
    },
    mounted(){
        this.getCartitems();
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.Auth.getToken()}`
    }
}
</script>
<style>
.p-menuitem-content .p-menuitem-link{
    text-decoration: none;
}
.el-menu-iem-box{
    width: 60rem;
}
@media only screen and (max-width: 600px){
    .el-menu-iem-box{
        width: 16rem;
    }
    .cart_side_bar{
        width: 100%;
    }
}
@media only screen and (min-width: 900px){
    .cart_side_bar{
        width: 40%;
    }
}
.cart-box-button{
    border-right: 1px solid #9ca3af;
}
</style>
