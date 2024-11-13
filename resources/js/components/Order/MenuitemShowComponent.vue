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
                        <div class="col-md-10 d-flex flex-column gap-2">
                            <Tag v-for="side of menuitem.side_dishes" class="d-flex cursor-p justify-content-between border bg-transparent">
                                <span>
                                    <small>{{ side.side_dish_name }}</small>
                                </span>
                                <span class="d-flex align-items-center gap-2">
                                    <small>{{ side.price }}</small>
                                    <Button text>
                                        <i class="pi pi-plus fw-bold" ></i>
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
                <div class="col-md-4 d-flex justify-content-between">
                    <div class="">
                        <Button class="border rounded-circle" icon="pi pi-plus" text />
                    </div>
                    <div class="d-flex align-items-center">
                        <Chip class="border rounded-circle" label="1"/>
                    </div>
                    <div>
                        <Button class="border rounded-circle" icon="pi pi-minus" text />
                    </div>
                    <div class="">
                        <Button style="white-space: nowrap;"@click="addToCard" class="rounded-pill" label="Adicionner et continuer" />
                    </div>
                </div>
                <div class="col-md-2 order-btn-box p-0">
                    <div class="w-100">
                        <Button @click="addToCard" class="rounded-pill border order-btn" label="commandez" text />
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
        addToCard(){
            if(this.Auth.hasRole('restaurant')){
                this.Notify.error('impossible de realiser une commande avec ce type de compte');
            }
        },
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
