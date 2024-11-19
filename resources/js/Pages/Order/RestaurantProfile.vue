<template>
   <NavbarComponent
        :cart-item-quantity="cartItemQuantity"
        :menuitems="cart_items"
        @updateCartUi="getCartitems"
   >
        <div class="container-fluid">
            <div class="row">
                <RestaurantProfileSidebar
                    :name="name"
                    :url-param-id="id"
                    :food-types="foodTypes"
                    @list-menuitems-by-resraurant-food-type="listMenuitemsByResraurantFoodType"
                />
                <MenuitemCardComponent
                    @show-menuitem="showMenuitem"
                    :restaurant-param-id="id"
                    :food-types="foodTypes"
                    :menuitems="menuitems"
                    @list-menuitems-by-resraurant-food-type="listMenuitemsByResraurantFoodType"
                >
                    <ListFoodTypeMobileComponent
                        :food-types="foodTypes"
                        @list-menuitems-by-resraurant-food-type="listMenuitemsByResraurantFoodType"
                    />
                </MenuitemCardComponent>
            </div>
            <div class="row">
                <Dialog v-model:visible="visibleShowMenuitemModal" :style="{ width: '85rem', borderRadius: '4rem' }">
                    <MenuitemShowComponent
                        :menuitem="menuitem"
                        @add-to-cart="addToCart"
                        @add-menuitem-side-dish="addMenuitemSideDish"
                    />
                </Dialog>
            </div>
        </div>
   </NavbarComponent>
</template>
<script>
import RestaurantProfileSidebar from '../../components/Order/RestaurantProfileSidebar.vue';
import MenuitemCardComponent from '../../components/Order/MenuitemCardComponent.vue';
import MenuitemShowComponent from '../../components/Order/MenuitemShowComponent.vue';
import ListFoodTypeMobileComponent from '../../components/Order/ListFoodTypeMobileComponent.vue';
export default {
    name: 'RestaurantProfile',

    components: {
        RestaurantProfileSidebar,
        MenuitemCardComponent,
        MenuitemShowComponent,
        ListFoodTypeMobileComponent
    },
    data(){
        return {
            name: this.$route.params.slug,
            id: this.$route.params.id,
            visibleShowMenuitemModal: false,
            menuitem: null,
            foodTypes: null,
            menuitems: null,
            cartItemQuantity: null,
            cart_items: null,
            side_dihes: null
        }
    },
    methods: {
        addMenuitemSideDish(item, sidedish){
            this.side_dihes = sidedish;
            document.getElementById('show_menuitem_add_and_next').classList.remove('p-disabled');
        },
        showMenuitem(id){
            this.Api.get(`/v1/menuitem/${id}`)
            .then(async response => {
                this.menuitem = await response.data.data;
                this.visibleShowMenuitemModal = true;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message);
            })
        },
        listRestaurantFoodTypes(){
            this.Api.get(`/v1/restaurant-food-type/list-by-restaurant/has-menuitems/${this.id}`)
            .then(async response => {
                this.foodTypes = await response.data.data
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        },
        listActivesMenuitems(){
            this.Api.get(`/v1/menuitem/list-active-by-restaurant/${this.id}`)
            .then(async response => {
                this.menuitems = await response.data.data;
            })
            .catch(error => {
                this.Notity.error(error.response.data.message);
            })
        },
        listMenuitemsByResraurantFoodType(id){
            this.Api.get(`/v1/menuitem/list-by-restaurant-food-type/${id}`)
            .then(async response => {
                this.menuitems = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message);
            })
        },
        addToCart(item){
            this.Cart.save(item.id, 1, item.name, item.price, item.image, this.side_dihes);
            this.Cart.addSideDish(item, this.side_dihes);
            this.getCartitems();
            this.visibleShowMenuitemModal = false;
            this.side_dihes = null;
        },
        getCartitems(){
            if (this.Cart.getItemsIds()){
                this.cart_items = this.Cart.get();
                this.cartItemQuantity = this.Cart.count();
            }
        },
    },
    mounted(){
        this.listRestaurantFoodTypes();
        this.listActivesMenuitems();
        this.getCartitems();
    }
}
</script>
<style>
.profile-sidebar-header{
    background-repeat: no-repeat;
    background-size: cover;
}
.btn-restaurant-sidebar-info{
    background-color: #334155;
    color: #cbd5e1;
}
.btn-restaurant-sidebar-back{
    background-color: #e2e8f0;
    color: #334155;
}
</style>
