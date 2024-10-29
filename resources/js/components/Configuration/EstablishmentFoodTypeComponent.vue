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
                     <el-table class="m-auto" :data="restaurantFoodTypes" style="width: 95%">
                         <el-table-column prop="name" label="Nom" />
                         <el-table-column show-overflow-tooltip prop="description" label="Descrition"/>
                         <el-table-column show-overflow-tooltip prop="active_status" label="status"/>
                         <el-table-column fixd="right" label="Actions">
                             <template  #default="scope">
                                 <el-popconfirm @confirm="deleteRestaurantFoodType(scope)" title="voulez vous supprimer ce type de plat ?" width="220">
                                     <template #reference>
                                         <el-button>
                                            <i class="pi pi-trash text-danger"></i>
                                         </el-button>
                                     </template>
                                 </el-popconfirm>
                                 <el-popconfirm @confirm="toggleActivateRestaurantFoodType(scope)" :title="popUpMessage(scope.row.is_active, 'type de plat')" width="220">
                                     <template #reference>
                                         <el-button>
                                            <i v-if="scope.row.is_active" class="pi pi-lock-open text-warning"></i>
                                            <i v-else class="pi pi-lock text-success"></i>
                                         </el-button>
                                     </template>
                                 </el-popconfirm>
                                 <el-button>
                                    <i class="pi pi-eye"></i>
                                 </el-button>
                             </template>
                         </el-table-column>
                     </el-table>
                </div>
             </div>
        </div>
        <Dialog v-model:visible="visibleListAllFoodTypeModal" modal :style="{ width: '65rem', borderRadius: '4rem' }">
             <div class="row mb-3">
                <FoodTypeDatableComponent
                   :food-types="post_data.food_types_id"
                   :is-for-admin="false"
                   @handle-is-active="handleIsActive"
                   @remove-food-type="removeFoodType"
                />
             </div>
             <div class="row p-2">
                <div class="col-md-10">
                    <label for="select-foodtypes" class="form-label fw-bold">Selectionnez vos types de plats</label>
                    <MultiSelect class="w-75" v-model="post_data.food_types_id" :options="foodTypes" option-label="name"></MultiSelect>
                </div>
                <div class="col-md-10 mt-3">
                    <Button @click="createRestaurantFoodTypes" class="general-btn" icon="pi pi-save" label="Enregistrer" />
                </div>
             </div>
         </Dialog>
     </div>
 </template>
 <script>
 import { is, when } from '../../core/Utilities';
import FoodTypeDatableComponent from '../datatables/FoodTypeDatableComponent.vue';
 export default{
    inject: ['popUpMessage'],
    name: 'EstablishmentFoodTypeComponent',

    components: {
       FoodTypeDatableComponent
    },

    data(){
        return {
           visibleListAllFoodTypeModal: false,
           post_data:{
               restaurant_id: this.Auth.authId(),
               food_types_id: []
           },
           foodTypes: null,
           restaurantFoodTypes: null
       }
    },
    methods: {
        onInactivatePromotion(){
                alert("Hey")
        },
        listAllFoodTypes(){
            this.Api.get('/v1/food-type/uncreated-by-restaurant/' + this.post_data.restaurant_id)
            .then(async response => {
                this.foodTypes = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        },
        removeFoodType(data){
            this.post_data.food_types_id.forEach((el, index) => {
                when(el.id === data.row.id, () => this.post_data.food_types_id.splice(index, 1))
            })
        },
        createRestaurantFoodTypes(){
            this.post_data.food_types_id = this.post_data.food_types_id.map(type => type.id);
            this.Api.post('/v1/restaurant-food-type', this.post_data)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.post_data.food_types_id = [];
                this.visibleListAllFoodTypeModal = false;
                this.listAllFoodTypes();
                this.listRestaurantFoodTypes();
            })
            .catch(error => {
                when(error.response.status === 422, this.Notify.error(error.response.data.message))
            })
        },
        listRestaurantFoodTypes(){
            this.Api.get(`/v1/restaurant-food-type/list-by-restaurant/${this.post_data.restaurant_id}`)
            .then(async response => {
                this.restaurantFoodTypes = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        },
        deleteRestaurantFoodType(data){
            this.Api.delete('/v1/restaurant-food-type/' + data.row.id)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.listAllFoodTypes();
                this.listRestaurantFoodTypes();
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        },
        toggleActivateRestaurantFoodType(data){
            this.Api.put(`/v1/restaurant-food-type/is-active/${data.row.id}`)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.listRestaurantFoodTypes()
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        }
    },
    mounted(){
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.Auth.getToken()}`
        this.listAllFoodTypes();
        this.listRestaurantFoodTypes();
    }
 }
 </script>
