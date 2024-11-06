<template>
    <NavbarComponent>
        <div class="container-fluid mt-3">
            <RestaurantFilterComponent />
            <RestaurantCategoryComponent
                :categories="categories"
             />
            <RestaurantCardComponent />
        </div>
    </NavbarComponent>
</template>
<script>
import RestaurantCategoryComponent from '../components/RestaurantCategoryComponent.vue';
import RestaurantFilterComponent from '../components/RestaurantFilterComponent.vue';
import RestaurantCardComponent from '../components/RestaurantCardComponent.vue';
export default{
    inject: ['check'],
    components: {
        RestaurantCategoryComponent,
        RestaurantFilterComponent,
        RestaurantCardComponent
    },
    data(){
        return {
            categories: null
        }
    },
    methods: {
        listAllCategories(){
            this.Api.get('/v1/category')
            .then(async response => {
                this.categories = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message);
            })
        },
    },
    mounted() {
        this.listAllCategories()
    }
}
</script>
