<template>
    <NavbarComponent>
        <div class="container-fluid">
           <div class="row">
                <div class="col-sm-3 sidebar">
                    <el-menu class="p-2">
                        <el-menu-item @click="componentIs='EstablishmentCategoryComponent'" index="1" class="fw-bold">Vos categorie</el-menu-item>
                        <el-menu-item @click="componentIs='EstablishmentFoodTypeComponent'" index="2" class="fw-bold">Vos type de plats</el-menu-item>
                        <el-menu-item @click="componentIs='EstablishmentPromotionComponent'" index="4" class="fw-bold">Vos promotions</el-menu-item>
                        <el-menu-item @click="componentIs='EstablishmentImagesComponent'" index="5" class="fw-bold">Images</el-menu-item>
                        <el-menu-item @click="componentIs = 'EstablishmentAddressComponent'" index="3" class="fw-bold">Address et ouverture-fermeture</el-menu-item>
                    </el-menu>
                </div>
                <div class="col-md-8">
                    <component :is="componentIs"></component>
                </div>
           </div>
        </div>
    </NavbarComponent>
</template>
<script>
import { defineAsyncComponent } from 'vue';
export default{
    name: 'Config.Establishement',

    components: {
        EstablishmentCategoryComponent: defineAsyncComponent(() =>
            import('../../../components/Configuration/EstablishmentCategoryComponent.vue')
        ),
        EstablishmentFoodTypeComponent: defineAsyncComponent(() =>
            import('../../../components/Configuration/EstablishmentFoodTypeComponent.vue')
        ),
        EstablishmentPromotionComponent: defineAsyncComponent(() =>
            import('../../../components/Configuration/EstablishmentPromotionComponent.vue')
        ),
        EstablishmentImagesComponent: defineAsyncComponent(() =>
            import('../../../components/Configuration/EstablishmentImagesComponent.vue')
        ),
        EstablishmentAddressComponent: defineAsyncComponent(() =>
            import('../../../components/Configuration/EstablishmentAddressComponent.vue')
        )
    },
    data(){
        return {
            componentIs: null,
        }
    },
    mounted(){
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.Auth.getToken()}`
    }
}
</script>
