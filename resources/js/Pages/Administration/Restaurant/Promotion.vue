<template>
    <NavbarComponent>
        <div class="container-fluid">
            <div class="row">
                <div class="colmd-8">
                    <Button @click="visibleCreatePromotionModal = true; promotion.id = null" class="general-btn" icon="pi pi-plus-circle" label="Nouvelle promotion" />
                    <Dialog v-model:visible="visibleCreatePromotionModal" modal :style="{ width: '45rem', borderRadius: '4rem' }">
                        <div class="row">
                            <div class="col-md-10 m-auto">
                                <div class="mb-3 d-flex flex-column">
                                    <input type="hidden" v-model="promotion.id">
                                    <label for="form-label">Nom</label>
                                    <InputText v-model="promotion.name" class="p-1" placeholder="nom de la promotion" />
                                    <small v-if="formErrors && formErrors.name" class="text-danger" v-text="formErrors.name.toString()"></small>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label for="form-label">Description</label>
                                    <Textarea v-model="promotion.description" class="p-1" placeholder="nom de la promotion" />
                                    <small v-if="formErrors && formErrors.description" class="text-danger" v-text="formErrors.description.toString()"></small>
                                </div>
                                <div v-if="promotion.id == null" class="mb-3 w-25 d-flex flex-column">
                                    <el-checkbox v-model="promotion.is_active" label="Activer ?" size="large" border />
                                </div>
                                <div class="mb-3 w-25 d-flex flex-column">
                                    <Button @click="handleFormSubmitAction" icon="pi pi-save" />
                                </div>
                            </div>
                        </div>
                    </Dialog>
                </div>
            </div>
            <div class="container mt-3">
                <div class="row">
                   <PromotionDatatableComponent
                        :promotions="promotions"
                        :is-for-admin="true"
                    />
                </div>
           </div>
        </div>
    </NavbarComponent>
</template>
<script>
import { isNull } from '../../../core/Utilities';
import PromotionDatatableComponent from '../../../components/datatables/PromotionDatatableComponent.vue';
export default{
    name: 'Administration.Promotion',

    components: {
        PromotionDatatableComponent
    },

    data(){
        return {
            visibleCreatePromotionModal: false,
            promotion:{
                id: null,
                name: null,
                description: null,
                is_active: true
            },
            promotions: null,
            formErrors: null
        }
    },
    methods: {
        handleFormSubmitAction(){
            if (isNull(this.promotion.id)){
                return this.createPromotion();
            }
            return this.updatePromotion()
        },
        handleTogglePromotionStatus(data){
            this.Api.put(`/v1/promotion/status/${data.row.id}`)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.listAllPromotions()
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        },
        createPromotion(){
            this.promotion.is_active == null ? this.promotion.is_active = false : this.promotion.is_active = true
            this.Api.post('/v1/promotion', this.promotion)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.formErrors = null;
                this.visibleCreatePromotionModal = false;
                this.promotion.name = null;
                this.promotion.description = null;
                this.listAllPromotions()
            })
            .catch(error => {
                if (error.response.status == 422){
                    return this.formErrors = error.response.data.errors;
                }
                this.Notify.error(error.response.data.message)
            })
        },
        updatePromotion(){
            this.Api.put('/v1/promotion', this.promotion)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.formErrors = null;
                this.visibleCreatePromotionModal = false;
                this.promotion.name = null;
                this.promotion.description = null;
                this.listAllPromotions()
            })
            .catch(error => {
                if (error.response.status == 422){
                    return this.formErrors = error.response.data.errors;
                }
                this.Notify.error(error.response.data.message)
            })
        },
        listAllPromotions(){
            this.Api.get('/v1/promotion')
            .then(async response => {
                this.promotions = await response.data.data;
            })
            .catch(error => {
                console.log(error)
                this.Notify.error(error.response.data.message)
            })
        },
        popPromoIsActiveMessage(status){
            return status === 1 ?
                "voulez vous desactiver cette promotion" :
                    "voulez vous activer cette promotion"
        },
        findPromotion(data){
            this.Api.get(`/v1/promotion/${data.row.id}`)
            .then(async response => {
                this.promotion = await response.data.data;
                this.visibleCreatePromotionModal = true;
            })
        }
    },
    mounted(){
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.Auth.getToken()}`
        this.listAllPromotions();
    }
}
</script>
