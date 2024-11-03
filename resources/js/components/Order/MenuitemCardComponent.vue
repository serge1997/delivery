<template>
    <div class="col-sm-10">
       <div class="row p-3 space-1 d-flex gap-2 mb-3">
            <div v-for="item in menuitems" @click="$emit('showMenuitem')" class="card col-sm-5 cursor-p food-card border-0 border-bottom">
                <div class="card-body d-flex justify-content gap-1">
                    <div class="food-card-text-content w-75 d-flex flex-column">
                        <div class="food-name">
                            <p>{{ item.name }}</p>
                        </div>
                        <div class="food-card-description mb-2">
                            <small>
                                Homus (200g) com iscas de alcatra e castanhas de caju na manteiga ghee
                            </small>
                        </div>
                        <div class="food-price">
                            <strong>
                                {{ item.price }}
                            </strong>
                        </div>
                    </div>
                    <div class="food-card-image-content d-flex flex-column justify-content-center align-items-center w-25">
                        <div class="w-100 mb-1">
                            <img style="width: 90%;" class="img-thumbnail rounded-circle" :src="`/images/menuitems/${item.image}`" alt="">
                        </div>
                        <div class="food-card-promotion d-flex justify-content-center">
                            <Tag icon="pi pi-gift" value="-15%" />
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
</template>
<script>
export default {
    name: 'MenuitemCardComponent',
    props: {
        visibleShowMenuitemModal: Boolean,
        restaurantParamId: Number
    },
    data(){
        return {
            menuitems: null
        }
    },
    methods: {
        listActivesMenuitems(){
            this.Api.get(`/v1/menuitem/list-active-by-restaurant/${this.restaurantParamId}`)
            .then(async response => {
                this.menuitems = await response.data.data;
            })
            .catch(error => {
                this.Notity.error(error.response.data.message);
            })
        }
    },
    mounted(){
        this.listActivesMenuitems()
    }
}
</script>
<style>
.food-name{
    font-family: "Raleway", sans-serif;
    font-weight: 400;
    font-size: 1.2em;
}
.food-price{
    font-family: "Raleway", sans-serif;
}

.food-card{
    background-color: #f8fafc;
    transition: .3s ease-in-out;
}
.food-card:hover{
    transform: scale(1.03);
}
.food-card-description{
    color:#71717a
}
</style>
