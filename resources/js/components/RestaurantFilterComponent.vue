<template>
    <div class="row mt-2 p-2">
        <div class="col-sm-10 p-0">
            <div class="w-100 d-flex align-items-center px-1 gap-1">
                <div><h6 class="icon-box-title">Filtre: </h6></div>
                <div class="w-75 d-flex align-items-center gap-1">
                    <div class="d-flex align-items-center">
                        <RestaurantFilterModalComponent />
                    </div>
                    <div class="d-flex align-items-center">
                        <Button @click="filterSelected" text class="d-flex align-items-center gap-1 restaurant-filter-button border rounded-3 p-1 shadow-sm">
                            <span><i class="pi pi-star-fill icon-filter-star"></i></span>
                            <span>+ 4.0</span>
                        </Button>
                    </div>
                    <div class="d-flex align-items-center">
                        <Button @click="filterSelected" text class="d-flex align-items-center justify-content-center gap-1 restaurant-filter-button border rounded-3 p-1 shadow-sm">
                            <span><i class="pi pi-money-bill icon-filter-star"></i></span>
                            <span>Promo</span>
                        </Button>
                    </div>
                    <div class="d-flex align-items-center">
                        <Button @click="filterSelected" text class="d-flex align-items-center justify-content-center gap-1 restaurant-filter-button border rounded-3 p-1 shadow-sm">
                            <span><i class="pi pi-sparkles icon-filter-star"></i></span>
                            <span>Nouveau</span>
                        </Button>
                    </div>
                    <div class="d-flex align-items-center">
                        <Button @click="filterSelected" text class="d-flex align-items-center justify-content-center gap-1 restaurant-filter-button border rounded-3 p-1 shadow-sm">
                            <span><i class="pi pi-bolt icon-filter-star"></i></span>
                            <span>35min</span>
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import RestaurantFilterModalComponent from './RestaurantFilterModalComponent.vue';
export default {
    name: 'ResturantFilterComponent',

    components: {
        RestaurantFilterModalComponent
    },
    data(){

    },
    methods: {
        filterSelected(e) {
            let target = e.target;
            if (target.nodeName == 'BUTTON'){
                return target.classList.toggle('is-selected')
            }
            target.parentElement.classList.toggle('is-selected')
        }
    }
}
</script>
<style>
.icon-box-title {
    color: #374151;
    font-weight: 600;
}
.restaurant-filter-button{
    font-size: 0.8em;
}
.restaurant-filter-button .icon-filter-star{
    color: #fbbf24;
    font-size: 0.9em;
}
.is-selected{
    background-color: #d4d4d8;
}
</style>
