<template>
    <div class="row">
        <div v-for="restaurant in restaurants" class="col-md-3">
            <div class="card w-100 border-0">
                <div style="background-image: url('/images/restaurant-card.png'); height: 210px;" class="card-body rounded-2 p-0">
                    <div class="w-75 bg-white p-1 mt-4 restaurant-promo-box">
                        <small class="px-2">Jusqu'á 50% off</small>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 p-0 mt-2">
                    <div class="w-100 d-flex gap-2">
                        <div style="max-width: 3rem;">
                            <img class="img-thumbnail w-100 rounded-circle" src="/images/rest-logo.png" alt="">
                        </div>
                        <div class="w-auto d-flex flex-column">
                            <span class="card-restaurant-name">
                                {{ restaurant.name }}
                            </span>
                            <span>
                                <small>25min</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'RestaurantCardComponent',

    data(){
        return {
            restaurants: null
        }
    },
    methods: {
        getAllActivesRestaurants(){
            this.Api.get('/v1/restaurant/actives/list-actives')
            .then(async response => {
                this.restaurants = await response.data.data;
            })
            .catch(error => {
                console.log(error)
                this.Notify.error(error.response.data.message)
            })
        }
    },
    mounted(){
        this.getAllActivesRestaurants();
    }
}
</script>
<style scoped>
.card{
    cursor: pointer;
    transition: .4s ease-in;
}
.card:hover{
    transform: scale(1.04);
}
.card-body{
    background-repeat: no-repeat;
    background-size: cover;
}
.card-restaurant-name{
    font-weight: 700;
    font-size: 1.1em;
    color: #374151;
}
.restaurant-promo-box{
    border-bottom-right-radius: 3rem;
    border-top-right-radius: 3rem;
}
.restaurant-promo-box small{
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: 700;
    color: #2563eb;
}
</style>
