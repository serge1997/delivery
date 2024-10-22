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
                        <el-menu-item index="3" class="fw-bold">Address et ouverture-fermeture</el-menu-item>
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
import EstablishmentCategoryComponent from '../../../components/Configuration/EstablishmentCategoryComponent.vue';
import EstablishmentFoodTypeComponent from '../../../components/Configuration/EstablishmentFoodTypeComponent.vue';
import EstablishmentPromotionComponent from '../../../components/Configuration/EstablishmentPromotionComponent.vue';
import EstablishmentImagesComponent from '../../../components/Configuration/EstablishmentImagesComponent.vue';
export default{
    name: 'Config.Establishement',

    components: {
        EstablishmentCategoryComponent,
        EstablishmentFoodTypeComponent,
        EstablishmentPromotionComponent,
        EstablishmentImagesComponent
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
