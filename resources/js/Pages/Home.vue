<template>
    <NavbarComponent>
        <div class="container-fluid mt-3">
            <RestaurantFilterComponent />
            <RestaurantTypeComponent />
            <RestaurantCardComponent />
        </div>
    </NavbarComponent>
</template>
<script>
import RestaurantTypeComponent from '../components/RestaurantTypeComponent.vue';
import RestaurantFilterComponent from '../components/RestaurantFilterComponent.vue';
import RestaurantCardComponent from '../components/RestaurantCardComponent.vue';
export default{
    components: {
        RestaurantTypeComponent,
        RestaurantFilterComponent,
        RestaurantCardComponent
    }
}
</script>
