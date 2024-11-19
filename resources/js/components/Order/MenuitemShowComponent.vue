<template>
    <div class="row">
        <div class="show-menuitem-header mb-3 w-100">
            <h5>{{ menuitem.name }}</h5>
        </div>
        <div class="show-menuitem-body mb-3 w-100">
            <div class="row">
                <div class="col-sm-4 image-box">
                    <img class="w-50" :src="`/images/menuitems/${menuitem.image}`" alt="">
                </div>
                <div v-if="menuitem.side_dishes.length" class="col-sm-7">
                    <div class="row">
                        <div class="col-md-10">
                            <h6>Accompagnements</h6>
                        </div>
                        <div v-if="Cart.hasItem(menuitem)" class="col-md-10 d-flex flex-column gap-2">
                            <Tag v-for="side of menuitem.side_dishes" class="d-flex cursor-p side_dish_tag justify-content-between border bg-transparent">
                                <span class="d-flex gap-2 align-items-center">
                                    <small><i :class="`${Cart.hasSideDish(menuitem, side) ? 'pi pi-check-circle text-success fw-bold' : 'pi pi-minus'}`"></i></small>
                                    <small>{{ side.side_dish_name }}</small>
                                </span>
                                <span v-if="Cart.hasSideDish(menuitem, side)" class="d-flex align-items-center gap-2 p-disabled">
                                    <small>{{ side.price }}</small>
                                    <Button id="btn_add_side_dish" class="p-disabled" @click="$emit('addMenuitemSideDish', menuitem, side)" text>
                                        <i class="pi pi-plus fw-bold small-btn-icon" ></i>
                                    </Button>
                                </span>
                                <span v-if="!Cart.hasSideDish(menuitem, side)" class="d-flex align-items-center gap-2 p-disabled">
                                    <small>{{ side.price }}</small>
                                    <Button id="btn_add_side_dish" class="p-disabled" @click="$emit('addMenuitemSideDish', menuitem, side)" text>
                                        <i class="pi pi-plus fw-bold small-btn-icon" ></i>
                                    </Button>
                                </span>
                            </Tag>
                        </div>
                        <div v-else class="col-md-10 d-flex flex-column gap-2">
                            <Tag v-for="side of menuitem.side_dishes" class="d-flex cursor-p justify-content-between border bg-transparent">
                                <span class="d-flex gap-2 align-items-center">
                                    <small><i class="pi pi-minus"></i></small>
                                    <small>{{ side.side_dish_name }}</small>
                                </span>
                                <span class="d-flex align-items-center gap-2">
                                    <small>{{ side.price }}</small>
                                    <Button id="btn_add_side_dish" @click="$emit('addMenuitemSideDish', menuitem, side)" text>
                                        <i class="pi pi-plus fw-bold small-btn-icon" ></i>
                                    </Button>
                                </span>
                            </Tag>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="show-menuitem-footer">
            <div class="row">
                <div class="col-md-4 d-flex gap-3">
                    <div class="" v-if="sideDishIsSelected()">
                        <Button id="show_menuitem_add_and_next" style="white-space: nowrap;" @click="$emit('addToCart', menuitem)" class="rounded-pill" label="Adicionner" />
                    </div>
                    <div class="" v-if="menuitem.side_dishes.length && !sideDishIsSelected()">
                        <Button id="show_menuitem_add_and_next" style="white-space: nowrap;" @click="$emit('addToCart', menuitem)" class="rounded-pill p-disabled" label="Adicionner" />
                    </div>
                    <div class="" v-if="!menuitem.side_dishes.length">
                        <Button id="show_menuitem_add_and_next" style="white-space: nowrap;" @click="$emit('addToCart', menuitem)" class="rounded-pill" label="Adicionner" />
                    </div>
                    <div class="" v-if="Cart.hasItem(menuitem)">
                        <Button id="show_menuitem_btn_order" class="rounded-pill border order-btn" label="commandez" text />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'MenuitemShowComponent',

    props: {
        menuitem: Object
    },
    data(){
        return {

        }
    },
    methods: {
        sideDishIsSelected(){
            if (this.Cart.hasItem(this.menuitem)){
                if (this.Cart.findItem(this.menuitem).side_dishes.length){
                    return true;
                }
            }
            return false;
        }

    },
    mounted(){

    }
}
</script>
<style>
@media only screen and (max-width: 600px) {

    .order-btn-box{
        margin-top: 8px;
    }
    .order-btn{
        width: 100%;
    }
}
</style>
