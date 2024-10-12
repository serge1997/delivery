<template>
    <div>
        <Button  class="restaurant-filter-button border rounded-3 p-1 shadow-sm" text @click="visibleRestaurantFilterModal = true" icon="pi pi-sliders-h" />
        <Dialog v-model:visible="visibleRestaurantFilterModal" modal :style="{ width: '25rem', borderRadius: '4rem' }">
            <div class="row">
                <div class="card w-100 border-0">
                    <div class="card-header border-0 bg-transparent">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="d-flex align-items-center">
                                    <Button text class="d-flex align-items-center gap-1 restaurant-filter-button border rounded-3 p-1 shadow-sm">
                                        <span><i class="pi pi-star-fill icon-filter-star"></i></span>
                                        <span>+ 4.0</span>
                                    </Button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Dialog>
    </div>
</template>
<script>
export default{
    name: 'RestaurantFilterModalComponent',
    data(){
        return {
            visibleRestaurantFilterModal: false
        }
    }
}
</script>
