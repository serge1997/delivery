<template>
    <div class="row d-flex flex-column justify-content-between mb-3 vh-100">
        <ul v-if="menuitems.length" class="list-group col-md-12">
            <li style="background-color: #e5e7eb;" v-for="menuitem of menuitems" class="list-group-item d-flex justify-content-between mb-4 p-0 border-0 shadow-sm">
                <div class="d-flex flex-column justify-content-center">
                    <div class="info-box d-flex align-items-center gap-1">
                        <div class="d-flex">
                            <span class="d-flex align-items-center">
                                <Button @click="$emit('removeFromCart', menuitem.id)" text>
                                    <i class="pi pi-trash text-danger small-btn-icon"></i>
                                </Button>
                            </span>
                            <span class="d-flex align-items-center bg-transparent">
                                <img style="width: 28px;" :src="`/images/menuitems/${menuitem.image}`" alt="">
                            </span>
                            <span class="d-flex align-items-center small-text d-flex gap-1">
                                <span class="px-1">
                                    {{ menuitem.name }}
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="mt-1">
                        <ul class="list-group" v-if="menuitem.side_dishes.length">
                            <li class="list-group-item border-0 d-flex gap-1" style="background-color: #e5e7eb;" v-for="side of menuitem.side_dishes">
                                <span class="d-flex align-items-center">
                                    <small class="small-text">{{ side.name }}({{side.total}} FCFA)</small>
                                </span>
                                <span class="d-flex align-items-center">
                                    <Chip>
                                        <small class="small-text">{{ side.quantity }}</small>
                                    </Chip>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="actions-box d-flex flex-column align-items-center justify-content-between gap-1">
                    <div>
                        <span style="white-space: nowrap;" class="fw-bold">{{ menuitem.item_total }} FCFA</span>
                    </div>
                    <div v-if="isForCartActions" class="d-flex">
                        <div class="">
                            <Button @click="$emit('incrementCartItemQuantity', menuitem)" class="border rounded-circle p-2" text>
                                <i class="pi pi-plus small-text"></i>
                            </Button>
                        </div>
                        <div class="d-flex align-items-center">
                            <Chip class="border rounded-circle">
                                <span class="small-text">{{ menuitem.quantity }}</span>
                            </Chip>
                        </div>
                        <div>
                            <Button  @click="$emit('reduceCartItemQuantity', menuitem)" class="border rounded-circle p-2" text>
                                <i class="pi pi-minus small-text"></i>
                            </Button>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div v-else class="d-flex justify-content-center p-3">
            <h6>Votre pannier est vide</h6>
        </div>
        <div v-if="isForCartActions && Cart.count()" class="row" style="margin-bottom: 100px;">
           <div class="col-md-12">
                <Button @click="saveOrderAndRedirect" id="confirm_order" class="rounded-pill w-100 border order-btn" label="commandez" text />
           </div>
        </div>
    </div>
    <div class="row">
        <Dialog v-model:visible="visibleCustomerLoginModal" modal header="Bienvenue !" :style="{ width: '25rem' }">
            <CustomerLoginComponent
                :must-be-connected="true"
             />
        </Dialog>
    </div>
</template>
<script>
import { defineAsyncComponent } from 'vue';
import { Cart } from '../../core/Cart';
export default {
    name: 'CartSidebarComponent',

    components: {
        CustomerLoginComponent: defineAsyncComponent(() =>
            import('../../Pages/Auth/CustomerLoginComponent.vue')
        )
    },
    props: {
        menuitems: Object,
        isForCartActions: Boolean
    },
    data(){
        return {
            visibleCustomerLoginModal: false
        }
    },
    methods: {
        saveOrderAndRedirect(){
            if (!this.Auth.isAuthenticated()){
                return this.visibleCustomerLoginModal = true;
            }
            this.$router.push({name: 'Checkout'})
        }
    }
}
</script>
