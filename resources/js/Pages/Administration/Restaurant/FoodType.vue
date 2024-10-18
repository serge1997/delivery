<template>
    <NavbarComponent>
        <div class="container-fluid">
            <div class="row">
                <div class="colmd-8">
                    <Button @click="visibleCreateFoodTypeModal = true" class="general-btn" icon="pi pi-plus-circle" label="Nouveaux type de plat" />
                    <Dialog v-model:visible="visibleCreateFoodTypeModal" modal :style="{ width: '45rem', borderRadius: '4rem' }">
                        <div class="row">
                            <div class="col-md-10 m-auto">
                                <div class="mb-3 d-flex flex-column">
                                    <input type="hidden" v-model="foodType.id"/>
                                    <label for="form-label">Nom</label>
                                    <InputText v-model="foodType.name" class="p-1" placeholder="nom de la promotion" />
                                    <small v-if="formErrors && formErrors.name" class="text-danger" v-text="formErrors.name.toString()"></small>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label for="form-label">Description</label>
                                    <Textarea v-model="foodType.description" class="p-1" placeholder="nom de la promotion" />
                                    <small v-if="formErrors && formErrors.description" class="text-danger" v-text="formErrors.description.toString()"></small>
                                </div>
                                <div class="mb-3 w-25 d-flex flex-column">
                                    <el-checkbox v-model="foodType.is_active" label="Activer ?" size="large" border />
                                </div>
                                <div class="mb-3 w-25 d-flex flex-column">
                                    <Button @click="handleFormSubmit" icon="pi pi-save" />
                                </div>
                            </div>
                        </div>
                    </Dialog>
                </div>
            </div>
            <div class="container mt-3">
                <div class="row">
                   <FoodTypeDatableComponent
                        :food-types="foodTypes"
                        :is-for-admin="true"
                        @handle-is-active="handleIsActive"
                        @find-food-type="findFoodType"
                   />
                </div>
           </div>
        </div>
    </NavbarComponent>
</template>
<script>
import FoodTypeDatableComponent from '../../../components/datatables/FoodTypeDatableComponent.vue';
import { when, popUpConfirmMessage } from '../../../core/Utilities';

export default{
    name: 'Administration.FoodType',
    components: {
        FoodTypeDatableComponent
    },

    data(){
        return {
            visibleCreateFoodTypeModal: false,
            foodType:{
                id: null,
                name: null,
                description: null,
                is_active: false
            },
            formErrors: null,
            foodTypes: null,
            popMessage : popUpConfirmMessage,
        }
    },
    methods: {
        onInactivatePromotion(){
            alert("Hey")
        },
        handleFormSubmit(){
            const method = when(this.foodType.id, "PUT", "POST");
            this.Api.send('/v1/food-type', method, this.foodType)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.visibleCreateFoodTypeModal = false;
                this.listAllFoodTypes()
            })
            .catch(error => {
                when(error.response.status === 422, 
                    this.formErrors = error.response.data.errors, 
                    this.Notify.error(error.response.data.message)
                );
            })
        },
        listAllFoodTypes(){
            this.Api.get('/v1/food-type')
            .then(async response => {
                this.foodTypes = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(`erreurs en listants les type de plats: ${error.response.data.message}`)
            })
        },
        findFoodType(data){
            this.Api.get(`/v1/food-type/${data.row.id}`)
            .then(async response => {
                this.foodType = await response.data.data;
                this.foodType.is_active = this.foodType.is_active == 1 ? true : false;
                this.visibleCreateFoodTypeModal = true;
            })
            .catch(error => {   
                this.Notify.error(`${error.response.data.message}`)
            })
        },
        handleIsActive(data){
            this.Api.put(`/v1/food-type/status/${data.row.id}`)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.listAllFoodTypes();
            })
            .catch(error => {   
                this.Notify.error(`${error.response.data.message}`)
            })
        }
    },
    mounted(){
        this.listAllFoodTypes();
    }
}
</script>
