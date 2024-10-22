<template>
    <div class="row">
         <div class="container mt-3">
            <div class="row mt-3">
                <h5>Type de de plats</h5>
            </div>
             <div class="row mt-3">
                 <div class="col-md-2">
                     <Button @click="visibleListAllFoodTypeModal = true" class="border rounded-3" text icon="pi pi-plus-circle" />
                 </div>
             </div>
             <div class="row mt-3">
                <div class="col-md-12 m-auto">
                     <el-table class="m-auto" :data="promotions" style="width: 95%">
                         <el-table-column prop="name" label="Nom" />
                         <el-table-column show-overflow-tooltip prop="description" label="Descrition"/>
                         <el-table-column fixd="right" label="Actions">
                             <template  #default>
                                 <el-button>
                                     <i class="pi pi-trash text-danger"></i>
                                 </el-button>
                                 <el-popconfirm @confirm="onInactivatePromotion" title="voulez vous desactiver cette promotion" width="220">
                                     <template #reference>
                                         <el-button>
                                             <i class="pi pi-lock-open text-warning"></i>
                                         </el-button>
                                     </template>
                                 </el-popconfirm>
                             </template>
                         </el-table-column>
                     </el-table>
                </div>
             </div>
        </div>
        <Dialog v-model:visible="visibleListAllFoodTypeModal" modal :style="{ width: '65rem', borderRadius: '4rem' }">
             <div class="row">
                <FoodTypeDatableComponent
                   :food-types="foodTypes"
                   :is-for-admin="false"
                   @handle-is-active="handleIsActive"
                />
             </div>
         </Dialog>
     </div>
 </template>
 <script>
 import FoodTypeDatableComponent from '../datatables/FoodTypeDatableComponent.vue';
 export default{
    name: 'EstablishmentFoodTypeComponent',

    components: {
       FoodTypeDatableComponent
    },

    data(){
        return {
           visibleListAllFoodTypeModal: false,
           promotion:{
               active: false
           },
           foodTypes: null
       }
    },
    methods: {
       onInactivatePromotion(){
            alert("Hey")
       },
       listAllFoodTypes(){
           this.Api.get('/v1/food-type/actives')
           .then(async response => {
               this.foodTypes = await response.data.data;
           })
       },
    },
    mounted(){
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.Auth.getToken()}`
        this.listAllFoodTypes();
    }
 }
 </script>
