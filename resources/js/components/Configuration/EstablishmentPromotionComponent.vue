<template>
    <div class="row">
         <div class="container mt-3">
            <div class="row mt-3">
                <h5>Vos promotions</h5>
            </div>
             <div class="row mt-3">
                 <div class="col-md-2">
                     <Button @click="visibleListAllPromotionModal = true" class="border rounded-3" text icon="pi pi-plus-circle" />
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
        <Dialog v-model:visible="visibleListAllPromotionModal" modal :style="{ width: '65rem', borderRadius: '4rem' }">
             <div class="row">
                <PromotionDatatableComponent
                    :promotions="promotions"
                    :is-for-admin="false"
                />
             </div>
         </Dialog>
     </div>
 </template>
 <script>
 import PromotionDatatableComponent from '../datatables/PromotionDatatableComponent.vue';
 export default{
    name: 'EstablishmentPromotionComponent',
    components: {
       PromotionDatatableComponent
    },

    data(){
        return {
           visibleListAllPromotionModal: false,
            promotion:{
                active: false
            },
            promotions: null
        }
    },
    methods: {
        onInactivatePromotion(){
            alert("Hey")
        },
        listAllActivesPromotions(){
            this.Api.get('/v1/promotion/actives')
            .then(async response => {
                this.promotions = await response.data.data;
            })
            .catch(error => {
                this.Notify.error(error.response.data.message)
            })
        }
    },
    mounted(){
        this.listAllActivesPromotions();
    }
 }
 </script>
