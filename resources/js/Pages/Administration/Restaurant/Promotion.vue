<template>
    <NavbarComponent>
        <div class="container-fluid">
            <div class="row">
                <div class="colmd-8">
                    <Button @click="visibleCreatePromotionModal = true" class="general-btn" icon="pi pi-plus-circle" label="Nouvelle promotion" />
                    <Dialog v-model:visible="visibleCreatePromotionModal" modal :style="{ width: '45rem', borderRadius: '4rem' }">
                        <div class="row">
                            <div class="col-md-10 m-auto">
                                <div class="mb-3 d-flex flex-column">
                                    <label for="form-label">Nom</label>
                                    <InputText v-model="promotion.name" class="p-1" placeholder="nom de la promotion" />
                                    <small v-if="formErrors && formErrors.name" class="text-danger" v-text="formErrors.name.toString()"></small>
                                </div>
                                <div class="mb-3 d-flex flex-column">
                                    <label for="form-label">Description</label>
                                    <Textarea v-model="promotion.description" class="p-1" placeholder="nom de la promotion" />
                                    <small v-if="formErrors && formErrors.description" class="text-danger" v-text="formErrors.description.toString()"></small>
                                </div>
                                <div class="mb-3 w-25 d-flex flex-column">
                                    <el-checkbox v-model="promotion.is_active" label="Activer ?" size="large" border />
                                </div>
                                <div class="mb-3 w-25 d-flex flex-column">
                                    <Button @click="createPromotion" icon="pi pi-save" />
                                </div>
                            </div>
                        </div>
                    </Dialog>
                </div>
            </div>
            <div class="container mt-3">
                <div class="row">
                   <div class="col-md-10 m-auto">
                        <el-table class="m-auto" :data="promotions" style="width: 95%">
                            <el-table-column prop="name" label="Nom" />
                            <el-table-column show-overflow-tooltip prop="description" label="Descrition"/>
                            <el-table-column prop="is_active" label="Active" />
                            <el-table-column prop="created_at" label="Créer le" />
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
        </div>
    </NavbarComponent>
</template>
<script>
export default{
    name: 'Administration.Promotion',

    data(){
        return {
            visibleCreatePromotionModal: false,
            promotion:{
                name: null,
                description: null,
                is_active: true
            },
            promotions: null,
            formErrors: null
        }
    },
    methods: {
        onInactivatePromotion(){
            alert("Hey")
        },
        createPromotion(){
            this.promotion.is_active == null ? this.promotion.is_active = false : this.promotion.is_active = true
            this.Api.post('/v1/promotion', this.promotion)
            .then(async response => {
                this.Notify.success(await response.data.message);
                this.formErrors = null;
                this.visibleCreatePromotionModal = false;
                this.listAllPromotions()
            })
            .catch(error => {
                console.log(error)
                if (error.response.status == 422){
                    this.formErrors = error.response.data.errors;
                }
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
        }
    },
    mounted(){
        this.listAllPromotions();
    }
}
</script>
