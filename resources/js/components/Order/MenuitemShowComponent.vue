<template>
    <div class="row">
        <div class="show-menuitem-header mb-3 w-100">
            <h5>{{ menuitem.name }}</h5>
        </div>
        <div class="show-menuitem-body mb-3 w-100">
            <div class="row">
                <div class="col-md-4 image-box">
                    <img class="w-50" :src="`/images/menuitems/${menuitem.image}`" alt="">
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
