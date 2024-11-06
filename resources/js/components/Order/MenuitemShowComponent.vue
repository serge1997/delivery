<template>
    <div class="row">
        <div class="show-menuitem-header mb-3 w-100">
            <h5>{{ menuitem.name }}</h5>
        </div>
        <div class="show-menuitem-body mb-3 w-100">
            <div class="row">
                <div class="col-md-4 image-box">
                    <img class="w-75" :src="`/images/menuitems/${menuitem.image}`" alt="">
                </div>
            </div>
        </div>
        <div class="show-menuitem-footer w-100">
            <div class="row">
                <div class="col-md-4 m-auto">
                    <div class="w-100 d-flex justify-content-between border rounded-pill">
                        <div class="">
                            <Button icon="pi pi-plus" text />
                        </div>
                        <div class="d-flex align-items-center">
                            <Chip label="1"/>
                        </div>
                        <div>
                            <Button icon="pi pi-minus" text />
                        </div>
                        <div class="">
                            <Button @click="addToCard" class="rounded-pill" label="Adicionner au panier" />
                        </div>
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
        }
    },
    mounted(){

    }
}
</script>
