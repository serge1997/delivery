<template>
   <NavbarComponent>
        <div class="container-fluid">
            <div class="row">
                <RestaurantProfileSidebar
                    :name="name"
                    :url-param-id="id"
                />
                <MenuitemCardComponent
                    @show-menuitem="showMenuitem"
                    :restaurant-param-id="id"
                />
            </div>
            <div class="row">
                <Dialog v-model:visible="visibleShowMenuitemModal" :style="{ width: '85rem', borderRadius: '4rem' }">
                    <MenuitemShowComponent
                        :menuitem="menuitem"
                    />
                </Dialog>
            </div>
        </div>
   </NavbarComponent>
</template>
<script>
import RestaurantProfileSidebar from '../../components/Order/RestaurantProfileSidebar.vue';
import MenuitemCardComponent from '../../components/Order/MenuitemCardComponent.vue';
import MenuitemShowComponent from '../../components/Order/MenuitemShowComponent.vue';
export default {
    name: 'RestaurantProfile',

    components: {
        RestaurantProfileSidebar,
        MenuitemCardComponent,
        MenuitemShowComponent
    },
    data(){
        return {
            name: this.$route.params.slug,
            id: this.$route.params.id,
            visibleShowMenuitemModal: false,
            menuitem: null
        }
    },
    methods: {
        showMenuitem(id){
            this.Api.get(`/v1/menuitem/${id}`)
            .then(async response => {
                this.menuitem = await response.data.data;
                this.visibleShowMenuitemModal = true;
            })
            .catch(error => {
                this.Notity.error(error.response.data.message);
            })
        }
    },
    mounted(){
        console.log(this.$route.params)
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
