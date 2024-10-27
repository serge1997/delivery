<template>
   <NavbarComponent>
        <div class="container-fluid">
            <RestaurantProfileSidebar
                :name="name"
           />
        </div>
   </NavbarComponent>
</template>
<script>
import RestaurantProfileSidebar from '../../components/Order/RestaurantProfileSidebar.vue';
export default {
    name: 'RestaurantProfile',

    components: {
        RestaurantProfileSidebar
    },
    data(){
        return {
            name: this.$route.params.slug
        }
    }
}
</script>
<style>
.profile-sidebar-header{
    background-repeat: no-repeat;
    background-size: cover;
}
.btn-restaurant-sidebar-info{
    background-color: #334155;
    color: #cbd5e1;
}
.btn-restaurant-sidebar-back{
    background-color: #e2e8f0;
    color: #334155;
}
</style>
